<?php
session_start();

//Controller file

//Turn on error reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once ('vendor/autoload.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default root
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home-page.html');
});

$f3->route('GET|POST /order', function ($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pet = $_POST['pet'];
        $color = $_POST['color'];
        if (empty($pet) || empty($color)) {
            echo "Please submit type in all inputs";
        } else {
            $f3->set('SESSION.pet', $pet);
            $f3->set('SESSION.color', $color);
            $f3->reroute("summary");
        }
    }
    $view = new Template();
    echo $view->render('views/order.html');
});

$f3->route('GET /summary', function () {
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();
