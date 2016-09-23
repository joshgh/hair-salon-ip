<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
        $name = $_POST['name'];
        $new_stylist = new Stylist($name);
        $new_stylist->save();
        return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });

    $app->delete("/", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render("home.html.twig", array('stylists' => Stylist::getAll()));
    });

    $app->get("stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->findClients();
        return $app['twig']->render("stylist.html.twig", array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $name = $_POST['name'];
        $stylist_id = $id;
        $new_client = new Client($name, $stylist_id);
        $new_client->save();
        $clients = $stylist->findClients();
        return $app['twig']->render("stylist.html.twig", array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->patch("stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $name = $_POST['name'];
        $stylist->update($name);
        $clients = $stylist->findClients();
        return $app['twig']->render("stylist.html.twig", array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->get("stylist/edit/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render("edit_stylist.html.twig", array('stylist' => $stylist));
    });

    return $app;
?>
