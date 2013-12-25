<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/translations'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'resource' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/:id',
                'constraints' => array( 'id' => '[0-9]+' )
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'show' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' => 'Collection-Translations-Resource'
                        )
                    )
                ),
                'download' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/download/package.zip',
                        'defaults' => array(
                            'controller' => 'Collection-Translations-Resource-Download'
                        )
                    )
                ),
                'file' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/file'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'replace' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'post',
                                'defaults' => array(
                                    'controller' => 'Collection-Translations-Resource-File-Upload'
                                )
                            )
                        )
                    )
                ),

                'delete' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'delete',
                        'defaults' => array(
                            'controller' => 'Collection-Translations-Resource-Delete'
                        )
                    )
                )
            )
        ),
        'list' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'get'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'show' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' => 'Collection-Translations-List'
                        )
                    )
                ),
                'module' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/modules',
                        'defaults' => array(
                            'controller' => 'Collection-Translations-Modules-List'
                        )
                    )
                )
            )
        ),
        'create' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'post',
                'defaults' => array(
                    'controller' => 'Collection-Translations-Create'
                )
            )
        )
    )
);
