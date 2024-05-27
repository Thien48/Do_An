<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table= 'topics';
    protected $fillable = [
        'id',
        'proposal_id',
    ];
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function instructs()
    {
        return $this->hasMany(Instruct::class);
    }
}
