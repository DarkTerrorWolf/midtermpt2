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
    $output = array(" This Midterm is easy"," This is a bit of a challenge"," I dont know how im going to pass! ");
    $f3->set('output',$output);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        $input = $_POST['out'];
        $name = $_POST["name"];
        $f3->set('name',$name);
        $f3->set('selected',$input);
        if(empty($name)){
            $f3->set('errors["name"]', "Please enter your name");
        }
        if(!isset($input)&& !in_array($input,$output)){
            $f3->set('errors["message"]', "Please select a message");
        }

        if (empty( $f3->get('errors'))){
            session_start();
            $_SESSION['name']=$name;
            $_SESSION['message'] = $input;
            $f3->reroute('summary');
        }
    }
    $view = new Template();
    echo $view->render("views/form.html");
});

$f3->route('GET /summary', function ($f3) {
    $view = new Template();
    echo $view->render("views/summary.html");
    session_destroy();
});

$f3->run();