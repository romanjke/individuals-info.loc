<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'korp', 'socr', 'street_code', 'index', 'gninmb', 'uno', 'ocatd', 'street_id'
    ];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function individuals()
    {
        return $this->hasMany(Individual::class);
    }
}
