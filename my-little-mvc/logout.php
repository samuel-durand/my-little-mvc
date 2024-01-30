<?php

require 'vendor/autoload.php';

use App\Controller\AuthenticationController;

$auth = new AuthenticationController();
$auth->logout();
