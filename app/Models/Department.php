<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'department_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'department_id',
        'name_department',
    ];

    public function lecturers()
    {
        return $this->hasMany(Lecturer::class, 'department_id', 'department_id');
    }
}
