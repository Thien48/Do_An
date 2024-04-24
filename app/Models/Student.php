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
        'telephone',
        'image',
        'user_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
