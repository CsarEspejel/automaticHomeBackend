<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // factory(User::class, 20)->create();

        User::create([
            'roles_fk' => 1,
            'name' => 'pedro',
            'email'=> 'pana@hola.com',
            'password' => bcrypt('putavida'),
            'phone' => '1234',
            'email_master' => '',
        ]);
    }
}
