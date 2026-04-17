<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface Verify2FAInterfaces
{
    public function generate2FASecret($User);
    public function enable2FA($User, $otp);
    public function verify2FA($User, $otp);
}
