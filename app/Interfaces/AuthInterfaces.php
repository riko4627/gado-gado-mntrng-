<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface AuthInterfaces
{
    public function findOrCreateUser($socialUser, $provider);
    public function createToken($user);
}
