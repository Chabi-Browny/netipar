<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'addresse',
        'mail_addresse',
    ];



}
