<?php

namespace App\Models;

use App\Models\Contracts\JsonBaseModel;

class User extends JsonBaseModel
{
    protected $table = 'users';
}