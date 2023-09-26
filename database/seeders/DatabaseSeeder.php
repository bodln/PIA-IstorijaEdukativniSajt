<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        //\App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Omer',
            'email' => 'omer@gmail.com'
        ]);

        Listing::create([
            'title' => 'test',
            'user_id' => $user->id,
            'tags' => 'tag1, tag2',
            'company' => 'company',
            'location' => 'here',
            'email' => 'test@gmail.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Exercitationem, repudiandae vel dicta alias tempora facilis provident obcaecati vero mollitia! 
            Amet, in! Soluta sit maiores vero impedit adipisci tempore cumque ad?'
        ]);

        Listing::create([
            'title' => 'test2',
            'user_id' => $user->id,
            'tags' => 'tag1, tag2',
            'company' => 'company',
            'location' => 'here',
            'email' => 'test@gmail.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Exercitationem, repudiandae vel dicta alias tempora facilis provident obcaecati vero mollitia! 
            Amet, in! Soluta sit maiores vero impedit adipisci tempore cumque ad?'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
