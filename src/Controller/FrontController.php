<?php

namespace App\Controller;

class FrontController
{

  function logAccess(){
    require 'log/access.log';

  }

  function logError(){
    require 'log/error.log';

  }

  function bddDemo(){
    require 'templates/orm.php';
  }

  function show($id)
  {
    echo "Je suis l'article ".$id;
  }

  function twigArticle(){
    try {
      $loader = new \Twig_Loader_Filesystem('templates');
      $twig = new \Twig_Environment($loader);
      $template = $twig->loadTemplate('test.html.twig');
      echo $template->render(array(
        'valeur_name' => 'Twig'));
    } catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
    }
  }

  function twigHome(){
    try {
      $loader = new \Twig_Loader_Filesystem('templates');
      $twig = new \Twig_Environment($loader);
      $template = $twig->loadTemplate('home.html.twig');
      echo $template->render(array(
        'valeur_name' => 'Twig'));
    } catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
    }
  }
}
