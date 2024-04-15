<?php

namespace App\Http\Services\User;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService
{
    // public function getDepartment()
    // {
    //     return Department::all();
    // }

    public function createUser($data)
    {
        $user = new User();

        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];

        $user->save();
        return $user;
    }
    public function updateUser(User $user, array $data)
    {

        $user->name = $data['name'];
        // update other fields

        $user->save();
    }
}
