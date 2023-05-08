<?php

namespace App\Models;

use App\Models\Contacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Description of Persons
 */
class Persons extends Model
{
    protected $table = 'persons';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'mail_address',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contacts::class);
    }
}