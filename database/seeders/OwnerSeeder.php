<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        $owners = [
            [
                'name'           => 'Budi Santoso',
                'phone'          => '081234567890',
                'address'        => 'Jl. Melati No. 1',
                'verified' => false,
            ],
            [
                'name'           => 'Siti Rahma',
                'phone'          => '082233445566',
                'address'        => 'Perumahan Griya Indah Blok A-12',
                'verified' => true,
            ],
            [
                'name'           => 'Andi Pratama',
                'phone'          => '083889922110',
                'address'        => 'Jl. Kenanga Timur No. 34',
                'verified' => false,
            ],
            [
                'name'           => 'Maria Fransiska',
                'phone'          => '089911223344',
                'address'        => 'Jl. Mawar Selatan No. 15',
                'verified' => true,
            ],
            [
                'name'           => 'David Fernando',
                'phone'          => '081355667788',
                'address'        => 'Jl. Sukamaju Permai No. 7',
                'verified' => false,
            ],
        ];

        foreach ($owners as $owner) {
            Owner::create($owner);
        }
    }
}
