<?php
function autoload($className) {
    $fileName = str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
      require $fileName;
    }
}
spl_autoload_register('autoload');
?>
