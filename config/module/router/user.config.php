<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/user'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'login' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/login'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'form' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'get',
                        'defaults' => array(
                            'controller' => 'HcbTranslations\Controller\MainController'
                        )
                    )
                ),
                'auth' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'HcbTranslations\Controller\User\Login\AuthController'
                        )
                    )
                )
            )
        ),
        'logout' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/logout',
                'defaults' => array(
                    'controller' => 'HcbTranslations\Controller\User\LogoutController'
                )
            )
        )
    )
);
