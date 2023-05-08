<?php

namespace App\Models;

use App\Models\Persons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Description of Contacts
 */
class Contacts extends Model
{
    protected $table = 'contacts';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'persons_id',
        'email',
        'phone'
    ];

    public function persons(): BelongsTo
    {
        return $this->belongsTo(Persons::class, 'persons_id');
    }
}
