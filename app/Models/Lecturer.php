<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
class Lecturer extends Model
{
    use HasFactory;
    protected $table= 'lecturers';
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
        return $this->belongsTo(User::class);
    }

    public function proposalForms()
    {
        return $this->hasMany(Proposal::class, 'lecturer_id');
    }


}
