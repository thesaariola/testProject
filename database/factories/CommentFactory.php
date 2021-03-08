<?php
use App\Models\Comment;
use Faker\Generator as Faker;

	$factory->define(Comment::class, function (Faker $faker) {
		return [
			'username' => $faker->name,
			'comment' => $faker->sentence(10)
		];
	});
