<?php

use App\Comic;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $comic = new Comic();
            $comic->title = $faker->words(2, true);
            $comic->description = $faker->text(50);
            $comic->thumb = $faker->imageUrl(360, 360, 'animals', true, 'cats');
            $comic->price = $faker->randomNumber(2, false);
            $comic->series = $faker->words(2, true);
            $comic->sale_date = $faker->date('Y-m-d');
            $comic->type = $faker->word();
            $comic->artist = $faker->words(2, true);
            $comic->writer = $faker->words(2, true);
            $comic->save();
        }
    }
}
