<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
class Lecturer extends Model
{
    use HasFactory;
    protected $table= 'lecturers';
    // protected $primaryKey = 'lecturers_id'; 
    protected $fillable = [
        'msgv',
        'name',
        'telephone',
        'degree',
        'gender',
        'image',
        'department_id ',
        'user_id',
    ];
    
    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
    public function department() 
    {
      return $this->belongsTo(Department::class);
    }

    // public function lecturer()
    // {
    //     return $this->belongsToMany(Department::class, User::class, 'department_id', 'user_id');
    // }

}
