<?php

namespace App\Models;

use App\Events\FormCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $dispatchesEvents = [
        'created' => FormCreated::class
    ];

    protected $fillable = [
        'type',
        'fields',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
