<?php


namespace App\Http\Middleware;


use App\Models\Token;
use Closure;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;

class CheckAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $access_token = $request->header('bearer');

        throw_if(is_null($access_token), new HttpClientException('missing bearer token'));

        $token = Token::firstWhere('access_token', $access_token);

        throw_if(is_null($token), new HttpClientException('invalid token'));

        throw_if(!$token->expires_in > 0, new HttpClientException('access token expired'));

        auth()->login($token->user);

        return $next($request);
    }

}