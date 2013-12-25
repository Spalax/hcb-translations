<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/clients'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'read' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'get'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'list' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' => 'Collection-Clients-List'
                        )
                    )
                )
            )
        ),
        'execute' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'post'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'block' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/block',
                        'defaults' => array(
                            'controller' => 'Collection-Clients-Block'
                        )
                    )
                )
            )
        )
    )
);
