<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

//F3 class
$f3 = Base::instance();

//Route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render("views/home.html");

});

$f3->route('GET|POST /form', function ($f3) {
    //echo "<h1>Hello World!</h1>";
    //if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //}
    $view = new Template();
    echo $view->render("views/form.html");
});

$f3->route('GET /summary', function ($f3) {

}
);

$f3->run();