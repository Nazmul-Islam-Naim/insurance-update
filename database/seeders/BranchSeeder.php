<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::updateOrCreate([
            'name' => 'Sylhet',
            'phone' => '0189895689',
            'email' => 'syl@gmail.com',
            'division' => 'Sylhet',
            'district' => 'Sylhet',
            'address' => 'Zinda Bazar',
        ]);
    }
}
