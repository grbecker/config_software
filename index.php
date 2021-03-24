<?php

require_once 'classes/Session.php';

spl_autoload_register(function($class) {
    if (file_exists('./control/' . $class . '.php')) {
        require_once './control/' . $class . '.php';
    }
});

$metodo = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

new Session;

if (Session::getValue('logged')) {
    $template = file_get_contents('html/index.html');
    $classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : null;
} else {
    $template = file_get_contents('html/login.html');
    $classe = 'LoginForm';
}

$content = '';
if (class_exists($classe)) {
    try {
        $pagina = new $classe($_REQUEST);
        if (!empty($metodo) AND method_exists($classe, $metodo)) {
            $pagina->$metodo($_REQUEST);
        }
        $content = $pagina->show();        
    } catch (Exception $e) {        
        $content = $e->getMessage() . '<br>' . $e->getTraceAsString();        
    }
} else {
    $content = "Classe '{$classe}' não definida";
}

if ($classe != 'LoginForm') {
    echo str_replace('{content}', $content, $template);
}