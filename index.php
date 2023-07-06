<?php
    include 'app.php';
    $GLOBALS['db'] = DBCLass::getInstance();
    $app = new app('path');