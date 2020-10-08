<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'My First Day at Rome',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante velit, pellentesque eu viverra condimentum, posuere vitae ex. In odio nunc, imperdiet vel placerat eget, ultrices vel elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'cover_image' => 'img1.jpg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Rome Cousine Tour',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante velit, pellentesque eu viverra condimentum, posuere vitae ex. In odio nunc, imperdiet vel placerat eget, ultrices vel elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'cover_image' => 'img2.jpg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Yacht Trip in Roman See',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante velit, pellentesque eu viverra condimentum, posuere vitae ex. In odio nunc, imperdiet vel placerat eget, ultrices vel elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'cover_image' => 'img3.jpg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Last Day at Rome',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante velit, pellentesque eu viverra condimentum, posuere vitae ex. In odio nunc, imperdiet vel placerat eget, ultrices vel elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'cover_image' => 'img4.jpg'
        ]);

    }
}
