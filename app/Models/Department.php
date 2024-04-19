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
    public function rules()
    {
        return [
            'name_department' => 'required'
        ];
    }
    public function Lecturer()
    {
        return $this->hasMany(Lecturer::class);
    }
    public static function getAllDepartments()
    {
        return Department::all();
    }
}
