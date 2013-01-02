<?php

require_once __DIR__ . '/public/bootstrap.php';

$app = new \Silex\Application();

//Configuration
$app->register( new \Silex\Provider\SessionServiceProvider() );
$app->register( new Silex\Provider\TwigServiceProvider() , array('twig.path' => DIR_ROOT .'/src/views'));

// route default
$app->get('/',function() use($app,$entityManager){
	return $app['twig']->render('index.twig');
} );

$app->get('/admin/teste',function() use($app,$entityManager){
	return $app['twig']->render('admin/teste.twig');
});