<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function Symfony\Component\Translation\t;

class Client extends Model
{
    use HasFactory;

    protected $appends = ['gender'];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getGenderAttribute()
    {
        return Gender::find($this->gender_id)->name;
    }
}
