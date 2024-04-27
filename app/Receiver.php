<?php

/*
*
*
*   Receive and handle form calls here
*   Create objects and return values here
*
*
*/
include 'Controller/Controller.php';
include 'Model/Model.php';

$cont = new Controller();
$model = new Model();

if (isset($_POST['reserve'])) {
    $name = ucwords($_POST['name']);
        $phone = $_POST['contact'];
        $from = $_POST['dateFrom'];
        $to = $_POST['dateTo'];
        $room = $_POST['rType'];
        $cap = $_POST['rCap'];
        $payment = $_POST['payment'];
        $datetime = $_POST['datetime'];

        $cont->computeTotal($name, $phone, $from, $to, $room, $cap, $payment, $datetime);
}
if (isset($_POST['save'])) {
    extract($_SESSION['data']);
    $model->addReservation($name, $phone, $date, $time, $from, $to, $room, $cap, $payment, $days, $sub, $disc, $add, $total, "Pending");
}