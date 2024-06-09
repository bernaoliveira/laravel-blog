<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $type = $i % 3 === 0 ? 'bad' : ($i % 3 === 1 ? 'average' : 'good');

            $rates = Rate::factory()
                ->count(10000)
                ->$type()
                ->make();

            $rates->chunk(2000)->each(function ($chunk) {
                Rate::insert($chunk->toArray());
            });
        }
    }
}
