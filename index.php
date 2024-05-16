<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload file
require_once ('vendor/autoload.php');

//instantiate the f3 base class
$f3 = Base::instance();

//define a default route
//https://dpjprogramming.greenriverdev.com/328/HelloFatFree/
$f3->route('GET /', function(){
    //echo '<h1> Hello Pets</h1>';

    //render view page
    $view = new Template();
    echo $view->render('views/home.html');
});

//order
$f3->route('GET|POST /order', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Validate the data
        if (empty($_POST['pet']) || empty($_POST['color']) || empty($_POST['type'])) {
            echo "Please supply a pet type";
        }

        else{
            if($_POST['type'] == "robot"){
                $pet = new RobotPet($_POST['pet'], $_POST['color']);
            }
            if($_POST['type'] == "stuffed"){
                $pet = new StuffedPet($_POST['pet'], $_POST['color']);
            }
            $f3->set('SESSION.pet', $pet);
            $f3->reroute("summary");
        }
    }

    $view = new Template();
    echo $view->render('views/pet-order.html');
});

$f3->route('GET /summary', function(){
    var_dump('SESSION.pet');
    //render view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

//run fat free
$f3->run();
?>