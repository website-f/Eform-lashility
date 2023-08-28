<?php

namespace App\Models;

use App\Events\FormCreated;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $dispatchesEvents = [
        'created' => FormCreated::class
    ];

    protected $fillable = [
        'type',
        'fields',
        'slug',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'type'
            ]
        ];
    }
}
