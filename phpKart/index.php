<?php
include 'CartSystem.php';

$cartSystem = new CartSystem();

$cartSystem->addCart(7, 1);

$cartSystem->addCart(3, 1);


$cartSystem->listItens();

$cartSystem->calculateTotal("DESCONTO10");
