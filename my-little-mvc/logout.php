<?php
session_start();
session_unset();
session_destroy();

header('Location: /my-little-mvc/login');
