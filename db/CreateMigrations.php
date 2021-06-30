<?php

require_once 'Connection.php';

$tipo = new Migration("teste1");
$tipo->addInt("id");
$tipo->addString("nome");
echo $tipo->create();

