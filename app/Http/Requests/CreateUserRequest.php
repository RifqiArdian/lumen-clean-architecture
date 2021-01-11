<?php

namespace App\Http\Requests;

class CreateUserRequest extends \Illuminate\Http\Request
{
    /**
     * @var mixed
     */
    public $name;
    public $email;
    public $password;
}
