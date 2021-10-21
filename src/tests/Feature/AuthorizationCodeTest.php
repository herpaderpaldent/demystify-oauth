<?php


namespace Tests\Feature;


use App\Models\Client;
use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Inertia\Testing\Assert;
use Tests\TestCase;

class AuthorizationCodeTest extends TestCase
{
    use RefreshDatabase;

    private int $client_id;
    private string $client_secret;

    /** @test */
    public function oneCanCreateAClient() {

        $client = Client::factory()->make();

        $this->assertCount(0, Client::all());

        $this->post(route('register.client'), [
            'application_name' => $client->name,
            'callback_url' =>  $client->callback_url,
            'email' =>  $client->email,
            'description' =>  $client->description,
        ])->assertRedirect();

        $this->assertCount(1, Client::all());

    }

    /** @test */
    public function authorizationRequest() {

        $client = Client::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/authorization-code/auth?' . http_build_query([
                'response_type' => 'code',
                'client_id' => $client->client_id
            ])
        )->assertInertia(fn(Assert $page) => $page->component('AuthorizeClient'));
    }

    /** @test */
    public function authorizationGrant() {

        $client = Client::factory()->create();
        $user = User::factory()->create();

        //Fake Events due to broadcasting
        Event::fake();

        // Front Channel
        $response = $this->actingAs($user)
            ->post(route('authorize.authorization-code'), [
                'client_id' => $client->client_id
            ]);

        $this->assertEquals(409, $response->status());

        //dd($response->headers->get('x-inertia-location'));

        $return_url = $response->headers->get('x-inertia-location');

        $url_arr = parse_url($return_url);
        $query = $url_arr['query'];

        $return_url_without_query = str_replace(array($query,'?'), '', $return_url);

        // assert that the redirect url is the same as the clients callback_url
        $this->assertEquals($client->callback_url, $return_url_without_query);

        // Check that the code is cached

        $this->assertCount(2, $exploded_query = explode('=', $query));
        $code = $exploded_query[1];

        $this->assertTrue(Cache::has($code));

        // Back Channel

        // first make sure we are not logged in
        $this->actingAs($user)->post('/logout');
        $this->assertGuest();

        $response = $this->post('/api/authorization-code/token', [
            'client_id' => $client->client_id,
            'client_secret' => $client->client_secret,
            'code' => $code,
            'grant_type' => 'authorization_code'
        ])->assertJson(fn(AssertableJson $json) => $json
            ->has('access_token')
            ->has('token_type')
            ->has('expires_in')
            ->has('refresh_token')
            ->has('scopes')
        );

        // finally let's try to use the access token to access the user endpoint

        $access_token = data_get(json_decode($response->getContent()), 'access_token');

        $this->assertGuest();

        $this->get('/api/user', [
            'bearer' => $access_token
        ])->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json->where('name', $user->name)->etc());

    }

    /** @test */
    public function oneCanRefreshAccessTokenWithRefreshToken()
    {
        $client = Client::factory()->create();
        $user = User::factory()->create();

        // create token
        $token = Token::create([
            'client_id' => (int) $client->id,
            'user_id' => (int) $user->id,
            'access_token' => base64_encode(Str::uuid()),
            'refresh_token' => base64_encode(Str::uuid()),
            'expires' => now()->subDay(),
            'scopes' => json_encode([])
        ]);

        // make sure it is expired
        $this->assertFalse($token->is_valid);

        // refresh access token

        $this->assertGuest();

        $response = $this->post('/api/authorization-code/token', [
            'client_id' => $client->client_id,
            'client_secret' => $client->client_secret,
            'refresh_token' => $token->refresh_token,
            'grant_type' => 'refresh_token'
        ])->assertJson(fn(AssertableJson $json) => $json
            ->has('access_token')
            ->has('token_type')
            ->has('expires_in')
            ->has('refresh_token')
            ->has('scopes')
        );

        // finally let's try to use the access token to access the user endpoint

        $access_token = data_get(json_decode($response->getContent()), 'access_token');

        $this->assertGuest();

        $response = $this->get('/api/user', [
            'bearer' => $access_token
        ])->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json->where('name', $user->name)->etc());

    }



}
