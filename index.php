<?php

require 'vendor/autoload.php';

$router = new App\Router\Router($_GET['url']);

$router->get('/', "Front#twigHome");
$router->get('/BDD', "Front#bddDemo");
$router->get('/Log/Error', "Front#logError");
$router->get('/Log/Access', "Front#logAccess");
$router->get('/posts', function(){ echo 'Tous les articles';}, 'Post');
//$router->get('/posts/:id', function($id){ echo "Afficher l'article " .$id; });
$router->get('/posts/:id', "Front#show");
$router->get('/article', "Front#twigArticle");
$router->post('/posts/:id', function($id){ echo "Poster l'article " .$id; });


$router->run();
