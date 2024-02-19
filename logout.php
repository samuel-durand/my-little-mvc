<?php
require 'vendor/autoload.php';

session_start();
use App\Controller\AuthenticationController;

$auth = new AuthenticationController();
$auth->logout();
