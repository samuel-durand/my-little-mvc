<?php
require_once 'vendor/autoload.php';
use App\Model\User;

$user = new User();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>
<body>
  <form method="post">
      <label>prénom</label>
      <input for="fullname">

        <label>email</label>
        <input for="email">

        <label>password</label>
        <input for="password" type="password">

        <button type="submit">S'inscrire</button>
  </form>

</body>
</html>