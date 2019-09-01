<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'Russian',
            'flag' => '',
            'abbr' => 'ru',
            'script' => 'Latn',
            'native' => 'Русский',
            'active' => '1',
            'default' => '1',
        ]);
        DB::table('languages')->insert([
            'name' => 'English',
            'flag' => '',
            'abbr' => 'en',
            'script' => 'Latn',
            'native' => 'English',
            'active' => '1',
            'default' => '0',
        ]);

        $this->command->info('Language seeding successful.');
    }
}
