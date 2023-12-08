<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition(): array
    {
        $address = ['Yangon','Mandalay','Mawlamyine','Bago','Pyin Oo Lwin','Pyay','Taung Gyi','Inn Lay'];
        return [
            'title' => $this -> faker -> sentence(8),
            'body' => $this ->faker -> text(200),
            'price' => rand(2000,50000),
            'address' => $address[array_rand($address)],
            'rating' => rand(0,5)
        ];
    }
}
