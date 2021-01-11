<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController Constructor
     *
     * @param UserService $userService
     *
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(){
        $user = $this->userService->getAll();
        return response()->json($user,200);
    }

    /**
     * Create a resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        $data = new CreateUserRequest();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $this->userService->create($data);
        return response()->json(null,200);
    }

    /**
     * Update a resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request,$id){
        $data = new UpdateUserRequest();
        $data->name = $request->name;
        $data->email = $request->email;
        $this->userService->updateById($data,$id);
        return response()->json(null,200);
    }

    /**
     * Delete a resource in storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id){
        $this->userService->deleteById($id);
        return response()->json(null,200);
    }
}
