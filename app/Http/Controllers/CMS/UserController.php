<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

use App\Traits\HttpResponseTraits;

class UserController extends Controller
{
    use HttpResponseTraits;
    protected $userRepo;
    public function __construct(UserRepositories $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    
    public function index(Request $request)
    {
        try {
            $data = $this->userRepo->getAllData($request);
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    public function createData(UserRequest $request)
    {
        try {
            $data = $this->userRepo->createData($request);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }
    public function getDataById($id)
    {
        try {
            $data = $this->userRepo->getDataById($id);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->dataNotFound();
        }
    }

    public function updateData(UserRequest $request, $id)
    {
        try {
            $data = $this->userRepo->updateData($id, $request);
            if (!$data) {
                return $this->idOrDataNotFound();
            }
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }
    public function deleteData($id)
    {
        $data = $this->userRepo->deleteData($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        return $this->delete();
    }
}

