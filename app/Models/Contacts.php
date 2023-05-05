<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Persons;

/**
 * Description of Contacts
 */
class Contacts extends Model
{
    protected $table = 'contacts';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'phone'
    ];

    public function persons(): BelongsTo
    {
        return $this->belongsTo(Persons::class, 'user_id');
    }
}
