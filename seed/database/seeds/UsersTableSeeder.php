<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'janedoe@test.com',
            'job' => 'Photographer',
            'tel' => '+31 102304506',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante velit, pellentesque eu viverra condimentum, posuere vitae ex. In odio nunc, imperdiet vel placerat eget, ultrices vel elit.',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'prof_pic' => 'janedoe.jpg'
        ]);

        factory(\App\User::class,3)->create();
    }
}
