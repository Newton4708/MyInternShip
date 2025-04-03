<?php
// config/routes.php

return [
    '' => ['controller' => 'home', 'action' => 'index'],
    'loginForm' => ['controller' => 'auth', 'action' => 'loginForm'],
    'login' => ['controller' => 'auth', 'action' => 'login'],
    'logout' => ['controller' => 'auth', 'action' => 'logout'],
    'entreprises' => ['controller' => 'entreprise', 'action' => 'list'],
    'offres' => ['controller' => 'offre', 'action' => 'list'],
    'candidatures' => ['controller' => 'candidature', 'action' => 'index'],
    'incription' => ['controller' => 'auth', 'action' => 'register'],
];
