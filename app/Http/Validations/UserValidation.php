<?php


namespace App\Http\Validations;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserValidation
{
    public function createUserValidation(CreateUserRequest $request){
        $validator = Validator::make((array)$request, [
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }
    }

    public function updateUserValidation(UpdateUserRequest $request){
        $validator = Validator::make((array)$request, [
            'email' => 'required|string|email|unique:users',
            'name' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }
    }
}
