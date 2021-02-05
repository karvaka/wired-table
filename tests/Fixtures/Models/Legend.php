<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Legend extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function classes(): array
    {
        return [
            'offencive',
            'defencive',
            'support',
            'recon'
        ];
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
