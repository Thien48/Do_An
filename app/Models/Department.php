<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name_department',
    ];
    // public function lecturer()
    // {
    //     return $this->hasMany(Lecturer::class);
    // }

    // public function department()
    // {
    //     return $this->belongsToMany(Lecturer::class, 'id');
    // }
    

    public static function getAllDepartments()
    {
        return Department::all();
    }
}
