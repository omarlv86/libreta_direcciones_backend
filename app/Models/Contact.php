<?php

namespace App\Models;

use App\Models\Mail;
use App\Models\Phone;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'note',
        'birthday',
        'page',
        'work',
        'status'
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function mails(): HasMany
    {
        return $this->hasMany(Mail::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
