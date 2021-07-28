<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use function Psy\debug;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        
        User::truncate();
        DB::table('type_user')->truncate();
        
        Schema::enableForeignKeyConstraints();
        
        factory(App\User::class, 10)->create();

        $usersIDs = DB::table('users')->pluck('id');
        $typesIDs = DB::table('types')->pluck('id');

            foreach (range(1,25) as $index) {
                DB::table('type_user')->insertOrIgnore([
                    'user_id' => $faker->randomElement($usersIDs),
                    'type_id' => $faker->randomElement($typesIDs),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
}
