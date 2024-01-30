<?php
require_once 'vendor/autoload.php';

use App\Model\Clothing;
use App\Model\Electronic;


$category = new Clothing();







if (array_key_exists('id', $_GET)) {
    // URL parameter exists
    echo 'URL parameter exists';
} else {
    // URL parameter does not exist
    echo 'URL parameter does not exist';
}
