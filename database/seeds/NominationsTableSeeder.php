<?php

use Illuminate\Database\Seeder;

class NominationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Nomination::class, 25)->create();
    }
}
