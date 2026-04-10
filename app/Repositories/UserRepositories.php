<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterfaces;
use App\Models\User;



class UserRepositories implements UserInterfaces
{
    protected $User;
    public function __construct(User $User)
    {
        $this->User = $User;
    }


    public function getAllData($request)
    {
        return $this->User->query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->when($request->role && $request->role !== 'Semua Role', function ($query) use ($request) {
                $query->where('role', $request->role);
            })
            ->latest()
            ->paginate($request->per_page ?? 10);
    }

    public function createData(UserRequest $request)
    {
        return $this->User->create($request->all());
    }

    public function getDataById($id)
    {
        return $this->User::findOrFail($id);
    }

    public function updateData($id, UserRequest $request)
    {
        $data = $this->User->find($id);
        if (!$data) {
            return null;
        }
        $data->update($request->all());
        return $data;
    }

    public function deleteData($id)
    {
        $data = $this->User->find($id);
        if (!$data) {
            return null;
        }
        return $data->delete();
    }
}

