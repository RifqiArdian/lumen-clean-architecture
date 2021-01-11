<?php

namespace App\Http\Requests;


class UpdateUserRequest extends \Illuminate\Http\Request
{
    /**
     * @var mixed
     */
    public $name;
    public $email;
}
