<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'mssv',
        'name',
        'class',
        'gender',
        'birthday',
        'telephone',
        'image',
        'user_id',
    ];
    public function user()
    {
        return $this->hasOne(Lecturer::class, 'user_id', 'id');
    }
}
