<?php

require 'vendor/autoload.php';


$Connection = new \ORM\Connection('localhost', 'framework', 'root', 'root');
var_dump('expression');
$EntityManager = new \ORM\Entity\Manager();

$Post = new \Entity\Post(); //New post
$Post->setTitle('My post title'); //Insert title
$Post->setContent('My post content'); //Insert content
$EntityManager->persist($Post); //Insert post in database


$router = new App\Router\Router($_GET['url']);

$router->get('/', function(){ echo 'Homepage'; }, 'Home');
$router->get('/posts', function(){ echo 'Tous les articles';}, 'Post');
//$router->get('/posts/:id', function($id){ echo "Afficher l'article " .$id; });
$router->get('/posts/:id', "Front#show");
$router->get('/article', "Front#twigArticle");
$router->post('/posts/:id', function($id){ echo "Poster l'article " .$id; });


$router->run();
