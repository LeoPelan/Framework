<?php

$Connection = new \ORM\Connection('localhost', 'framework', 'root', 'root');
$EntityManager = new \ORM\Entity\Manager();

$Post = new \Entity\Post(); //New post
$Post->setTitle('Exemple Title'); //Insert title
$Post->setContent('Exemple content'); //Insert content
$EntityManager->persist($Post); //Insert post in database


?>
