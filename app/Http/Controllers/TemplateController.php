<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositories;
use App\Repositories\KinexaRepositories;

class TemplateController extends Controller
{
    protected $userRepo;
    protected $kinexaRepo;

    public function __construct(UserRepositories $userRepo, KinexaRepositories $kinexaRepo)
    {
        $this->userRepo = $userRepo;
        $this->kinexaRepo = $kinexaRepo;
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

    public function kinexa()
    {
        return view('admin.kinexa');
    }

    public function kinexaSummary()
    {
        $data = $this->kinexaRepo->getPegawaiSummary();
        return response()->json($data);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authCallback()
    {
        return view('auth.callback');
    }

    public function approvals(Request $request)
    {
        $appController = app(\App\Http\Controllers\CMS\ApprovalController::class);
        return $appController->index($request);
    }
}

