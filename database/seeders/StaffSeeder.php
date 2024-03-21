<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff =[
            [
            'staff_id' => '111',
            'name' => 'amirrul'
            ],
            [
            'staff_id' => '222',
            'name' => 'haiqal'
            ],
            [
            'staff_id' => '333',
            'name' => 'tengku'
            ],
            [
            'staff_id' => '444',
            'name' => 'yusoff'
            ],
        ];

        Staff::insert($staff);
    }
}
