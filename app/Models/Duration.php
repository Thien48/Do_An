<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
    protected $table= 'duration';
    protected $fillable = [
        'id ',
        'registration_start_date',
        'registration_end_date',
        'proposed_start_date',
        'proposed_end_date',
    ];
}
