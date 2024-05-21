<?php
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
    echo $view->render('views/home-page.html');
});

//order
$f3->route('GET|POST /order', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Validate the data
        if (empty($_POST['pet']) || empty($_POST['color']) || empty($_POST['type'])) {
            echo "Please supply a pet type";
        }
        else{
            $pet = null;
            if($_POST['type'] == "robotic"){
                $pet = new RobotPet($_POST['pet'], $_POST['color']);
            } else if ($_POST['type'] == "stuffed"){
                $pet = new StuffedPet($_POST['pet'], $_POST['color']);
            }

            $f3->set('SESSION.pet', $pet);
            $f3->reroute($_SESSION['pet'] instanceof RobotPet ? 'robot-order' : 'stuffed-order');
        }
    }

    $view = new Template();
    echo $view->render('views/order.html');
});

$f3->route('GET|POST /robot-order', function($f3) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['accessories'])) {
            echo "Please supply a pet type";
        } else {
            $f3->get('SESSION.pet')->setAccessories($_POST['accessories']);
            $f3->reroute('summary');
        }
    }

    $view = new Template();
    echo $view->render('views/robot-order.html');
});

$f3->route('GET|POST /stuffed-order', function($f3) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->get('SESSION.pet')->setStuffingType($_POST['stuffing']);
        $f3->get('SESSION.pet')->setMaterial($_POST['material']);
        $f3->get('SESSION.pet')->setSize($_POST['size']);
        $f3->reroute('summary');
    }

    $view = new Template();
    echo $view->render('views/stuffed-order.html');
});

$f3->route('GET /summary', function($f3) {
    $pet = $f3->get('SESSION.pet');
    $f3->set('color', $pet->getColor());
    $f3->set('animal', $pet->getAnimal());
    $f3->set('type', $f3->get('SESSION.pet') instanceof RobotPet ? "Robotic" : "Stuffed");
    $optional = array();
    if ($f3->get('type') == 'Robotic') {
        $optional['Accessories'] = implode(', ', $pet->getAccessories());
    } else {
        $optional['Size'] = $pet->getSize();
        $optional['Stuffing'] = $pet->getStuffingType();
        $optional['Material'] = $pet->getMaterial();
    }
    $f3->set('optional', $optional);
    //render view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//run fat free
$f3->run();
