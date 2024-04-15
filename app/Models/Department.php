<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name_department',
    ];
    public function Lecturer()
    {
        return $this->hasMany(Lecturer::class); 
    }
    public static function getAllDepartments() {
        return Department::all();
    }
}
