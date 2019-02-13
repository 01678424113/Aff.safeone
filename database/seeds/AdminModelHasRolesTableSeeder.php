<?php

use App\Models\AdminModelHasRoles;
use Illuminate\Database\Seeder;

class AdminModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminModelHasRoles::create([
            'role_id' => 1,
            'model_type' => 'App\Models\Admin',
            'model_id' => 1,
        ]);
    }
}
