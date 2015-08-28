<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    //Set up debugging and Silex path
    use Symfony\Component\Debug\Debug;
    Debug::enable();
    $app = new Silex\Application();

    //Set path to MySQL
    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    //Configuration to allow _method input to work
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Set path for Twig
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    //Path to the homepage
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/shoes", function () use($app) {
        return $app['twig']->render('shoes.html.twig', array('shoes'=>Shoe::getAll()));
    });

    return $app;
?>
