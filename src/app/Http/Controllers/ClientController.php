<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ClientController extends Controller
{

    public function create()
    {
        session(['shouldShowDetailsView' => true]);

        return inertia('Client/Registration');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'application_name' => ['required', 'string'],
            'callback_url' =>  ['required', 'string'],
            'email' =>  ['required', 'string'],
            'description' =>  ['required', 'string', 'max:500'],
        ]);

        $client = Client::create([
            'client_id' => random_int(1_000_000, 9_999_999),
            'client_secret' => Str::uuid(),
            'name' => data_get($data, 'application_name'),
            'callback_url' => data_get($data, 'callback_url'),
            'email' => data_get($data, 'email'),
            'description' => data_get($data, 'description'),
        ]);

        if(session()->pull('shouldShowDetailsView')) {
            return inertia('Client/Details', [
                'client_id' => $client->client_id,
                'client_secret' => $client->client_secret
            ]);
        }

        session(['client' => [
            'client_id' => $client->client_id,
            'client_secret' => $client->client_secret],
            'redirect_uri' => $client->callback_url
        ]);

        return redirect()->back();

    }
}
