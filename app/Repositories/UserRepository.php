<?php


namespace App\Repositories;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * PostRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Save Post
     *
     * @return Collection
     */
    public function getAll():Collection{
        return $this->user->newQuery()
            ->get();
    }

    /**
     * create user.
     *
     * @param CreateUserRequest $data
     */
    public function create(CreateUserRequest $data){
        $this->user->newQuery()->create([
           "name" => $data->name,
           "email" => $data->email,
           "password" => $data->password,
        ]);
    }

    /**
     * update user.
     *
     * @param UpdateUserRequest $data
     * @param int $id
     */
    public function updateById(UpdateUserRequest $data, int $id){
        $this->user->newQuery()->where('id',$id)->first()->update([
            "name" => $data->name,
            "email" => $data->email,
        ]);
    }

    /**
     * delete user.
     *
     * @param int $id
     */
    public function deleteById(int $id){
        try {
            $this->user->newQuery()->where('id', $id)->first()->delete();
        } catch (Exception $e) {
            throw new BadRequestHttpException('Invalid id');
        }
    }
}
