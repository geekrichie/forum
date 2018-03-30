<?php

use Faker\Generator as Faker;
use App\Models\Link;

$factory->define(Link::class, function (Faker $faker) {
    return [
        //生成数据集合
      'title' => $faker->name,
      'link'  => $faker->url,

    ];
});
