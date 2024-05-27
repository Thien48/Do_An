<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposal_form';
    protected $fillable = [
        'proposed_date',
        'approval_date',
        'name',
        'target',
        'request',
        'references',
        'status',
        'year',
        'subject_id',
        'lecturer_id',
    ];
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }
    public function topics()
    {
        return $this->hasMany(Topic::class, 'proposal_id');
    }
}
