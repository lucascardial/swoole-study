<?php

namespace TheMembers\Shortner\Http\Controllers;

use Core\Request\Request;

class JpController
{
    public function __invoke(Request $request): string
    {
       return "Olá, JP!";
    }
}