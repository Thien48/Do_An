<?php

namespace App\Http\Services\User;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService
{

    public function createUser($data)
    {
        $user = new User();

        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];

        $user->save();
        return $user;
    }
    public function createUserStudent($data)
    {
        $user = new User();

        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'sv';

        $user->save();
        return $user;
    }
    public function updateUserLecturer(User $user, array $data)
    {

        $user->name = $data['name'];
        $user->save();
        return $user;
    }
}
