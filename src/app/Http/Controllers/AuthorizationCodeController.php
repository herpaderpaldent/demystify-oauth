<?php


namespace App\Http\Controllers;


use App\Events\AuthorizationGranted;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        broadcast(new AuthorizationGranted($client->client_id, array_merge(['method' => 'GET', 'url' => $redirect_url], $redirect_data)));

        return redirect()->to($redirect_url);
    }

    public function grant(Request $request)
    {
        $validated_data = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'client_secret' => ['required', 'exists:clients,client_secret'],
            'grant_type' => ['required', 'string', Rule::in(['authorization_code'])],
            'code' => ['required', 'string']
        ]);

        $auth_code_data = Cache::pull(data_get($validated_data, 'code'));

        $token = Token::create([
            'client_id' => data_get($auth_code_data, 'client_id'),
            'user_id' => data_get($auth_code_data, 'user_id'),
            'access_token' => base64_encode(Str::uuid()),
            'refresh_token' => base64_encode(Str::uuid()),
            'scopes' => json_encode(data_get($auth_code_data, 'scopes'))
        ]);

        return collect([
            'access_token' => $token->access_token,
            'token_type' => 'bearer',
            'expires_in' => $token->refresh()->expires_in,
            'refresh_token' => $token->refresh_token,
            'scopes' => $token->refresh()->scopes
        ])->toJson();
    }

}