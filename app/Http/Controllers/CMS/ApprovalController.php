<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Tampilkan halaman daftar user untuk Super Admin.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->get('status', 'pending');

        $users = User::when($statusFilter !== 'all', function ($query) use ($statusFilter) {
            $query->where('status', $statusFilter);
        })
        ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        $counts = [
            'pending'  => User::where('status', 'pending')->count(),
            'approved' => User::where('status', 'approved')->count(),
            'rejected' => User::where('status', 'rejected')->count(),
            'all'      => User::count(),
        ];

        return view('admin.approvals', compact('users', 'counts', 'statusFilter'));
    }

    /**
     * Approve user.
     */
    public function approve(string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'status'      => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('toast_success', "Pengguna {$user->name} berhasil disetujui.");
    }

    /**
     * Reject user.
     */
    public function reject(string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'status'      => 'rejected',
            'approved_at' => null,
        ]);

        return back()->with('toast_error', "Pengguna {$user->name} telah ditolak.");
    }
}
