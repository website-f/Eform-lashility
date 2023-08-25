<?php

namespace App\Models;

use App\Events\SubmissionCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submitted extends Model
{
    use HasFactory, SoftDeletes;

    protected $dispatchesEvents = [
        'created' => SubmissionCreated::class
    ];

    protected $fillable = [
        'type',
        'fields',
    ];

    public function published() 
    {
        return $this->belongsTo(User::class, 'publisher_id', 'id');
    }
}

