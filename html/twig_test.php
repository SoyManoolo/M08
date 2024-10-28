<?php

// Codigo para comprobar los errores que no aparecen por pantalla

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Código de Twig para el primer template


require_once "vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
	'cache' => 'cache',
]);

echo $twig->render('index.html', ['name' => 'Fabien']);


// Codigo de Twig para el segundo template
/*
require_once "vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
	'cache' => 'cache',
]);


$education = [
	[
		'degree' => 'Batxillerat Tecnològic',
		'year' => '2020 - 2022',
	],
	[
		'degree' => 'Administració de Sistemes Informàtics en Xarxa',
		'year' => '2022 - 2024',
	],
	[
		'degree' => 'Desenvolupament d\'Aplicacions Web',
		'year' => '2024 - 2025',
	],
	[
		'degree' => '42Barcelona',
		'year' => '2024 - 2026',
	]
];

$work_experience = [
	[
		'role' => 'Helpdesk',
		'year' => 'September 2023 - February 2024',
	]
];

$learning = [
	[
		'language' => 'C',
	],
	[
		'language' => 'PHP',
	],
	[
		'language' => 'TypeScript',
	],
	[
		'language' => 'Java',
	]
];

echo $twig->render('index.html', [
	'titulo' => 'CV mgrl39',
	'name' => 'mgrl39',
	'emoji' => '👾',
	'social_network' => 'Github',
	'social_link' => 'www.github.com/mgrl39',
	'education' => $education,
	'work_experience' => $work_experience,
	'learning' => $learning,
]);
*/
?>