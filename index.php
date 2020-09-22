<?php include 'config.php';

// if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
// $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// header('HTTP/1.1 301 Moved Permanently');
// header('Location: ' . $location);
// exit;
// }

// include 'vars.php';
// include 'helper/functions.php';
// include 'class.php';
// include 'user.php';
include 'helper/routes.php';

include 'includes/header.php';

include 'pages/' . $page . '.php';

include 'includes/footer.php';
