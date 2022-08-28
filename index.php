<?php

require_once ('vendor/autoload.php');

//use Blacking\TaskForce\Task;
//new Task(1);

use Blacking\TaskForce\import\DataImporter;

$categories = new DataImporter("data/categories.csv", ['name', 'icon'], 'categories', 'categories_data');
$categories->convert();

$cities = new DataImporter("data/cities.csv", ['name', 'lat', 'long'], 'cities', 'cities_data');
$cities->convert();
