<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Legend extends Model
{
    use HasFactory;

    const CLASS_OFFENSIVE = 'offensive';
    const CLASS_DEFENSIVE = 'defensive';
    const CLASS_SUPPORT = 'support';
    const CLASS_RECON = 'recon';

    protected $guarded = ['id'];

    public static function classes(): array
    {
        return [
            static::CLASS_OFFENSIVE,
            static::CLASS_DEFENSIVE,
            static::CLASS_SUPPORT,
            static::CLASS_RECON
        ];
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
