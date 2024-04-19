<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
class Lecturer extends Model
{
    use HasFactory;
    protected $table= 'lecturers';
    protected $primaryKey = 'lecturers_id'; 
    protected $fillable = [
        'lecturers_id',
        'department_id ',
        'user_id',
        'name',
        'telephone',
        'degree',
        'gender',
        'image',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, );
    }

}
