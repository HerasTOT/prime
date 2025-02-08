<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    protected string $routeName;
    protected string $source;

    public function __construct()
    {
        $this->routeName = "welcome.";
        $this->source    = "Welcome/";
    }

    public function welcome(){
        return Inertia::render("{$this->source}Welcome", [
            'title'   => 'Bienvenido',
            'routeName' => $this->routeName,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
