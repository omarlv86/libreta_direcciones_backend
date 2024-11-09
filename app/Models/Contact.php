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
        'name',
        'note',
        'birthday',
        'page',
        'work',
    ];

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function mail(): HasMany
    {
        return $this->hasMany(Mail::class);
    }

    public function phone(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
