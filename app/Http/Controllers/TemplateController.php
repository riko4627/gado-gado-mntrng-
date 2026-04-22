<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        // Statistik nyata dari database
        $stats = [
            'total_users'    => User::count(),
            'approved_users' => User::where('status', 'approved')->count(),
            'pending_users'  => User::where('status', 'pending')->count(),
            'rejected_users' => User::where('status', 'rejected')->count(),
            'super_admins'   => User::where('role', 'super_admin')->count(),
            'admins'         => User::where('role', 'admin')->count(),
            'users'          => User::where('role', 'user')->count(),
        ];

        // 5 user terbaru yang sudah approved
        $recentUsers = User::where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        // User pending yang menunggu persetujuan
        $pendingUsers = User::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'pendingUsers'));
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


