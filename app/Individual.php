<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
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
        'fio', 'passport', 'sex', 'house', 'flat', 'house_id'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
