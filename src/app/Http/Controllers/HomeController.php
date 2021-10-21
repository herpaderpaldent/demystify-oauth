<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {

        $data = [
            'client' => session('client'),
            'user' => auth()->user(),
            'code' => session('code')
        ];

        return Inertia::render('Welcome', array_merge($data, [
            'currentStep' => collect($data)->filter()->count() + 1
        ]));
    }
}
