<?php

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\EventManager as EventManager,
    Doctrine\ORM\Events,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry, 
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\ClassLoader;

// Define o diretorio raiz do projeto
define('DIR_ROOT', realpath(dirname(__FILE__) . '/../'));
// Define o diretorio das Bibliotecas
define('DIR_VENDOR',realpath(dirname(__FILE__) . '/../vendor/') );
//define o SEPARATOR
define('DS',DIRECTORY_SEPARATOR);


$loader = require DIR_VENDOR . '/autoload.php';
$loader->add('Reservas',DIR_ROOT . '/src');

//doctrine
$config = new Configuration();
$cache = new \Doctrine\Common\Cache\ApcCache();
$config->setQueryCacheImpl( $cache );
$config->setProxyDir('/tmp');
$config->setProxyNamespace('EntityProxy');
$config->setAutoGenerateProxyClasses(true);

//doctrine mapping
AnnotationRegistry::registerFile( DIR_VENDOR . DS . 'doctrine' . DS . 'orm' . DS . 'lib' . DS . 'Doctrine' . DS . 'ORM' . DS . 'Mapping' . DS . 'Driver' . DS . 'DoctrineAnnotations.php');

$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
	new \Doctrine\Common\Annotations\AnnotationReader(),
	array( DIR_ROOT . '/src' )
);
$config->setMetadataDriverImpl( $driver );
$config->setMetadataCacheImpl( $cache );

$entityManager = EntityManager::create(
	array(
		'driver' 	=>	'pdo_mysql',
		'host'	 	=>	'localhost',
		'port'	 	=>	'3306',
		'user'	 	=>	'root',
		'password'	=>	'aspire5542',
		'dbname'	=>	'chat',
	),
	$config
);