<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserInterfaces
{
    public function getAllData($request);
    public function createData(UserRequest $request);
    public function getDataById($id);
    public function updateData($id, UserRequest $request);
    public function deleteData($id);
}
