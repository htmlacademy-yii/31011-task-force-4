<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'email' => $faker->email,
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'name' => $faker->name,
    'date' => $faker->date,
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
];
