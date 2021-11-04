<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {

        return Inertia::render('Home', [
            'exampleImage' => asset('/images/authorizationCodeFlowExample.png')
        ]);
    }
}
