<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kladr extends Model
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
        'name', 'socr', 'code', 'index', 'gninmb', 'uno', 'ocatd', 'status'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kladr';

    public function streets()
    {
        return $this->hasMany(Street::class);
    }
}
