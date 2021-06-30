<?php

require_once 'Connection.php';
require_once 'Migration.php';

$tipo = new Migration("tipo_teste1");
$tipo->addInt("id");
$tipo->addString("nome");
echo $tipo->create();

