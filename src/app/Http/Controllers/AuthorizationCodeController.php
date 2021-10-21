<?php


namespace App\Http\Controllers;


use App\Events\AuthorizationGranted;
use App\Models\Client;
use App\Models\Token;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AuthorizationCodeController
{
    public function request(Request $request)
    {
        $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'response_type' => [
                'required',
                function ($attribute, $value, $fail) {
                    if($value !== 'code') {
                        $fail('The '.$attribute.' is invalid and must be «code».');
                    }
                }
            ]
        ]);

        $client = Client::firstWhere('client_id', data_get($request, 'client_id'));

        return inertia('AuthorizeClient', [
            'client_name' => $client->name,
            'client_id' => $client->client_id,
            'state' => data_get($request, 'state'),
            'scopes' => explode(' ', data_get($request, 'scope')),
        ]);

    }

    public function authorize(Request $request)
    {
        $validated_data = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'state' => ['string'],
            'scopes' => ['array']
        ]);

        $client = Client::firstWhere('client_id', data_get($request, 'client_id'));

        $auth_code = base64_encode(Str::uuid());

        // cache auth_code for 1 minute
        Cache::put($auth_code, [
            'user_id' => auth()->user()->getAuthIdentifier(),
            'client_id' => $client->id,
            'scopes' => data_get($validated_data, 'scopes'),
        ], 60);

        $redirect_data = [
            'code' => $auth_code,
            'state' => data_get($validated_data, 'state')
        ];

        $redirect_url = sprintf('%s?%s', $client->callback_url, http_build_query($redirect_data));

        session()->put('code', $auth_code);
        broadcast(new AuthorizationGranted($client->client_id, array_merge(['method' => 'GET', 'url' => $redirect_url], $redirect_data)));

        return Inertia::location($redirect_url);
    }

    public function grant(Request $request)
    {
        $validated_data = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'client_secret' => ['required', 'exists:clients,client_secret'],
            'grant_type' => ['required', 'string', Rule::in(['authorization_code', 'refresh_token'])],
            'code' => ['required_without:refresh_token', 'string'],
            'refresh_token' => ['required_without:code', 'string']
        ]);

        // first check if client_id and client_secret belong together
        $client = Client::query()
            ->where('client_id', data_get($validated_data, 'client_id') )
            ->where('client_secret', data_get($validated_data, 'client_secret'))
            ->first();

        throw_if(is_null($client), new Exception('client not found', 403));

        $grant_type = data_get($validated_data, 'grant_type');

        return match ($grant_type) {
            'authorization_code' => $this->issueToken($validated_data),
            'refresh_token' => $this->updateToken($validated_data),
        };

    }

    private function issueToken(array $validated_data) : string
    {
        $auth_code_data = Cache::pull(data_get($validated_data, 'code'));

        $token = Token::create([
            'client_id' => data_get($auth_code_data, 'client_id'),
            'user_id' => data_get($auth_code_data, 'user_id'),
            'access_token' => base64_encode(Str::uuid()),
            'refresh_token' => base64_encode(Str::uuid()),
            'expires' => now()->addHour(),
            'scopes' => json_encode(data_get($auth_code_data, 'scopes'))
        ]);

        return $this->buildTokenJsonResponse($token);

    }

    private function updateToken(array $validated_data)
    {
        $token = Token::query()
            ->whereHas('client', fn(Builder $query) => $query->where('client_id', data_get($validated_data, 'client_id')))
            ->where('refresh_token', data_get($validated_data, 'refresh_token'))
            ->first();

        throw_if(is_null($token), new Exception('refresh_token not found', 403));

        $token->update([
            'access_token' => base64_encode(Str::uuid()),
            'refresh_token' => base64_encode(Str::uuid()),
            'expires' => now()->addHour()
        ]);

        return $this->buildTokenJsonResponse($token);

    }

    private function buildTokenJsonResponse(Token $token) : string
    {
        return collect([
            'access_token' => $token->access_token,
            'token_type' => 'bearer',
            'expires_in' => $token->refresh()->expires_in,
            'refresh_token' => $token->refresh_token,
            'scopes' => $token->refresh()->scopes
        ])->toJson();
    }

}
