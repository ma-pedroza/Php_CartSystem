<?php
include 'kartSystem.php';

$kartSystem = new KartSystem();

$kartSystem->addKart(7, 1);

$kartSystem->addKart(3, 1);


$kartSystem->listItens();

$kartSystem->calculateTotal("DESCONTO10");


?>