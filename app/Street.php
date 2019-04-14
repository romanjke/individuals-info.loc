<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
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
        'name', 'socr', 'code', 'index', 'gninmb', 'uno', 'ocatd', 'kladr_id'
    ];

    public function kladr()
    {
        return $this->belongsTo(Kladr::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
