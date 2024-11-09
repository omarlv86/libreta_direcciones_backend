<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Address extends Model
{
    use HasFactory;

    public function contact(): belongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
