<?php

require_once 'Connection.php';

$conn = Connection::open();
$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `categoria` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `essencial` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "categoria..OK";
}

$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `logotipo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "empresa..OK";
}

$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `indices` (
  `id_empresa` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `correcao` float DEFAULT NULL,
  `teste` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`ano`,`mes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "indices..OK";
}


$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `lancamentos` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` float NOT NULL,
  `valor_indice` float DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `paga` varchar(1) DEFAULT NULL,
  `anexo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "lancamentos..OK";
}

$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `projeto` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `observacao` text,
  `status` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "projeto..OK";
}

$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `status` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cor` varchar(150) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "status..OK";
}


$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `tipo` (
  `id` varchar(1) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "tipo..OK";
}


$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `tipo_pagamento` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `icone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "tipo_pagamento..OK";
}

$result = $conn->prepare("CREATE TABLE IF NOT EXISTS `usuario` (
  `id_empresa` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` text,
  PRIMARY KEY (`id_empresa`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
if (!$result->execute()) {
    die(print_r($result->errorInfo()));
} else {
    echo "usuario..OK";
}

$result = $conn->prepare("SELECT * FROM usuario");
$result->execute();
if ($result->rowCount() == 0) {
    $result = $conn->prepare("INSERT INTO `usuario` VALUES (1,1,'Guilherme','guilherme@psinf.com.br','73a203c6c187cd06382ba46af68c92a7')");
    $result->execute();
}

$result = $conn->prepare("SELECT * FROM status");
$result->execute();
if ($result->rowCount() == 0) {
    $result = $conn->prepare("INSERT INTO `status` VALUES (1,1,'PROJETOS EM ANDAMENTO','info',1),(1,2,'PROJETOS EM APROVACAO','secondary',2),(1,3,'AGUARDANDO EXECUCAO','warning',3),(1,4,'EXECUCAO EM ANDAMENTO','primary',4),(1,5,'EM AVERBACAO','info',5),(1,6,'FINALIZADO','success',6),(1,9,'OUTROS','dark',7),(1,7,'AGUARDANDO PROJETO','danger',0)");
    $result->execute();
}
