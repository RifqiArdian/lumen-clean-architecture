<?php


namespace App\Repositories;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAll():Collection;
    public function create(CreateUserRequest $data);
    public function updateById(UpdateUserRequest $data, int $id);
    public function deleteById(int $id);
}
