<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('answers')->truncate();
        DB::table('questions')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::factory()->count(3)->create()->each(function ($u) {
            $u->questions()
              ->saveMany(
                  Question::factory()->count(rand(1, 5))->make()
              )
              ->each(function ($q) {
                  $q->answers()->saveMany(Answer::factory()->count(rand(1, 5))->make());
              });
        });
    }
}
