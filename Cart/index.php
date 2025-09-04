<?php
include 'CartSystem.php';

$cartSystem = new CartSystem();

$cartSystem->addCart(1,2);

$cartSystem->addCart(3, 16);

$cartSystem->removeItemFromCart(1);

$cartSystem->addCart(1,2);

$cartSystem->finishCart('DESCONTO10');