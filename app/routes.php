<?php 

return [
    '/' => [
        'controller' => 'HomeController',
        'method' => 'index'
    ],
    '/article' => [
        'controller' => 'ArticleController',
        'method' => 'index'
    ],
    '/signup' => [
        'controller' => 'AccountController',
        'method' => 'signup'
    ],
    '/login' => [
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'AuthController',
        'method' => 'logout'
    ],
    '/category' => [
        'controller' => 'ArticleController',
        'method' => 'filterArticlesByCategory'
    ]
];