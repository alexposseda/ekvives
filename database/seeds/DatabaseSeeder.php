<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Testimonial;
use App\Models\Document;
use App\Models\Price;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Testimonial::class, 30)->create();
        factory(Document::class, 30)->create();
        factory(Price::class, 30)->create();
        User::create(['email' => 'qwerty@qwerty.com', 'name' => 'qwerty', 'password' => bcrypt('qwerty')]);
        factory('App\Models\Slide', 3)->states('with_image')->create(['show' => 1]);
        factory('App\Models\Category', 6)->states('with_image')->create(['anchored' => 1]);
        factory('App\Models\Category', 6)->states('with_image')->create(['anchored' => 0]);
        factory('App\Models\Product', 10)->states('with_image')->create(['category_id' => 1]);
        factory('App\Models\Product', 10)->states('with_image')->create(['category_id' => 2]);
        factory('App\Models\Product', 10)->states('with_image')->create(['category_id' => 3]);
        factory('App\Models\Product', 10)->states('with_image')->create(['category_id' => 4]);
        factory('App\Models\Product', 10)->states('with_image')->create(['category_id' => 5]);
        factory('App\Models\Article', 15)->states('with_image')->create(['anchored' => 1]);
        factory('App\Models\Article', 15)->states('with_image')->create(['anchored' => 0]);
        factory('App\Models\Gallery', 25)->states('with_image')->create();
        $this->call(LangTableSeeder::class);

    }
}
