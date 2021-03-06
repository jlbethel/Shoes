<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    //Set up debugging and Silex path
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();


    $app['debug'] = true;

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

    //paths for stores list page
    $app->get("/brands", function () use($app) {
        return $app['twig']->render('brands.html.twig', array('brands'=>Brand::getAll()));
    });

    $app->post("/brands", function() use($app) {
        $brand_name = $_POST['brand_name'];
        $brand = new Brand($brand_name);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' =>Brand::getAll()));
    });

    $app->post("/delete_brands", function() use($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' =>Brand::getAll()));
    });

    //paths for individual brand pages
    $app->get("/brands/{id}", function($id) use($app){
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'all_stores' => Store::getAll()));
    });

    $app->post("/add_stores", function() use($app){
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //paths for stores list page
    $app->get("/stores", function () use($app) {
        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));
    });

    $app->post("/stores", function() use($app) {
        $store_name = $_POST['store_name'];
        $store = new Store($store_name);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' =>Store::getAll()));
    });

    $app->post("/delete_stores", function() use($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' =>Store::getAll()));
    });

    //paths for individual store pages
    $app->get("/stores/{id}", function($id) use($app){
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'all_brands' => Brand::getAll()));
    });

    $app->post("/add_brands", function() use($app){
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //paths for individual store edit pages
    $app->get("/stores/{id}/edit", function($id) use($app){
        $store = Store::find($id);
        return $app['twig']->render('edit_store.html.twig', array('store' => $store));
        });

    $app->patch("/stores/{id}", function($id) use($app){
        $store_name = $_POST['store_name'];
        $store = Store::find($id);
        $store->updateName($store_name);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });


    $app->delete("/delete_store/{id}", function($id) use($app){
            $store = Store::find($id);
            $store->delete();
            return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
        });

    return $app;
?>
