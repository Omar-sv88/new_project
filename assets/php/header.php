<?php

require_once './app/config/config.php';
require_once CONFIG_PATH.'classes_autoloader.php';

if (!SESSION::have() && !HELPER::isIndex()) { HELPER::redirect('index.php?case=nologin'); }

?>


<base href="<?php echo BASE_PATH; ?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="author" content="Developer CloudXData">

<?php require_once 'styles.php'; ?>