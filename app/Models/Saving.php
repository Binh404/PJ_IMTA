<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_id',
        'amount',
        'note',
    ];
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

}