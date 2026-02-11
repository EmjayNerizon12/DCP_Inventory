<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolEquipment\SchoolEquipmentAllotmentClass;

class SchoolEquipmentAllotmentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed 10 allotment classes
        SchoolEquipmentAllotmentClass::factory()->count(10)->create();
    }
}
