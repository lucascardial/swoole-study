<?php

namespace TheMembers\Shortner\Http\Controllers;

use Core\Request\Request;

class LeandroController
{
    public function __invoke(Request $request): string
    {
        return "Olá, Leandro!";
    }
}