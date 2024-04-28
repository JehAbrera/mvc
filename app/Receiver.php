<?php

/*
*
*
*   Receive and handle form calls here
*   Create objects and return values here
*
*
*/
require_once 'Controller/Controller.php';
require_once 'Model/Model.php';

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

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $cont->loginAuth($user, $pass);
}

if (isset($_POST['page'])) {
    $page = $_POST['page'];
    $model->viewList($page);
}

if (isset($_POST['find'])) {
    $page = $_SESSION['page'];
    $name = $_POST['name'];

    $model->findReserve($page, $name);
}

if (isset($_POST['update'])) {
    $id = $_POST['valueId'];

    if ($_POST['update'] == "Accepted" || $_POST['update'] == "Rejected") {
        $update = $_POST['update'];
        $model->updateStatus($update, $id);
    } else {
        $model->deleteInfo($id);
    }
}