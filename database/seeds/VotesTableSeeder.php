<?php

use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidate_ids = App\User::where('candidate', 1)->where('active', 1)->pluck('id')->all();
        $voter_ids = App\User::where('active', 1)->pluck('id');

        foreach($voter_ids as $id) {
            App\Vote::create([
                'voter_id' => $id,
                'candidate_id' => $candidate_ids[array_rand($candidate_ids)]
            ]);

        }

        \Illuminate\Support\Facades\DB::table('users')
            ->update(['voted_on'=>now()]);
    }
}
