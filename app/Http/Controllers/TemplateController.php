<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositories;

class TemplateController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositories $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users(Request $request)
    {
        $users = $this->userRepo->getAllData($request);
        return view('admin.users', compact('users'));
    }

    public function proyektor()
    {
        return view('admin.proyektor');
    }
}

