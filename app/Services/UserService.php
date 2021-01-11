<?php


namespace App\Services;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Validations\UserValidation;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all user.
     *
     * @return Collection
     */
    public function getAll():Collection{
        return $this->userRepository->getAll();
    }

    /**
     * Create User.
     *
     * @param CreateUserRequest $request
     */
    public function create(CreateUserRequest $request){
        (new UserValidation)->createUserValidation($request);
        $request->password = Hash::make($request->password);
        $this->userRepository->create($request);
    }

    /**
     * Update User.
     *
     * @param UpdateUserRequest $request
     * @param $id
     */
    public function updateById(UpdateUserRequest $request, $id){
        (new UserValidation)->updateUserValidation($request);
        $this->userRepository->updateById($request,$id);
    }

    /**
     * Delete User.
     *
     * @param $id
     */
    public function deleteById($id){
        $this->userRepository->deleteById($id);
    }

}
