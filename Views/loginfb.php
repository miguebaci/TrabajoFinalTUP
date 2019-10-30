<?php

//session_start();
$fb = new Facebook\Facebook([
  'app_id' => '2460451207325213', // Replace {app-id} with your app id
  'app_secret' => '9af682d41351182a21de000a6efc1f48',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/TrabajoFinalTUP/User/FBCallback', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>