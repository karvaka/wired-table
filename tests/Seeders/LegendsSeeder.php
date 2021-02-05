<?php

namespace Tests\Seeders;

use Tests\Fixtures\Models\Legend;
use Illuminate\Database\Seeder;

class LegendsSeeder extends Seeder
{
    public function run(): void
    {
        $legends = [
            [
                'name' => 'Bangalore',
                'occupation' => 'Professional Soldier',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Wraith',
                'occupation' => 'Interdimensional Skirmisher',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Mirage',
                'occupation' => 'Holographic Trickster',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Octane',
                'occupation' => 'High-Speed Daredevil',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Revenant',
                'occupation' => 'Synthetic Nightmare',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Horizon',
                'occupation' => 'Gravitational Manipulator',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Fuse',
                'occupation' => 'Explosives Enthusiast',
                'class' => Legend::CLASS_OFFENSIVE
            ],
            [
                'name' => 'Gibraltar',
                'occupation' => 'Shielded Fortress',
                'class' => Legend::CLASS_DEFENSIVE
            ],
            [
                'name' => 'Caustic',
                'occupation' => 'Toxic Trapper',
                'class' => Legend::CLASS_DEFENSIVE
            ],
            [
                'name' => 'Wattson',
                'occupation' => 'Static Defender',
                'class' => Legend::CLASS_DEFENSIVE
            ],
            [
                'name' => 'Rampart',
                'occupation' => 'Base of Fire',
                'class' => Legend::CLASS_DEFENSIVE
            ],
            [
                'name' => 'Lifeline',
                'occupation' => 'Combat Medic',
                'class' => Legend::CLASS_SUPPORT
            ],
            [
                'name' => 'Loba',
                'occupation' => 'Translocating Thief',
                'class' => Legend::CLASS_SUPPORT
            ],
            [
                'name' => 'Bloodhound',
                'occupation' => 'Technological Tracker',
                'class' => Legend::CLASS_RECON
            ],
            [
                'name' => 'Pathfinder',
                'occupation' => 'Forward Scout',
                'class' => Legend::CLASS_RECON
            ],
            [
                'name' => 'Crypto',
                'occupation' => 'Surveillance Expert',
                'class' => Legend::CLASS_RECON
            ],
        ];

        collect($legends)->each(function ($data) {
            Legend::factory()->create($data);
        });
    }
}
