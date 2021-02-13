<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    const CLASS_TANK = 'tank';
    const CLASS_DAMAGE = 'damage';
    const CLASS_SUPPORT = 'support';

    protected $guarded = ['id'];

    public static function classes(): array
    {
        return [
            static::CLASS_TANK,
            static::CLASS_DAMAGE,
            static::CLASS_SUPPORT
        ];
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
