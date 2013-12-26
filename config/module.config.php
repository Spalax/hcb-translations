<?php
return array(
    'router' => include __DIR__ . '/module/router.config.php',

    'doctrine' => array(
        'driver' => array(
            'app_driver' => array(
                'paths' => array(__DIR__ . '/../src/HcbTranslations/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'HcbTranslations\Entity' => 'app_driver'
                )
            )
        )
    ),

    'di' => include __DIR__ . '/module/di.config.php',

    'translator' => array (
        'translation_file_patterns' => array (
            'HcbTranslations' => array (
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo'
            )
        )
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'HcbTranslations' => __DIR__ . '/../public',
            )
        )
    ),

    'hcb-translations' => array (
        'package_lang_dirs' => array(
            'HcbTranslations' => array(
                'gettext' => array(
                    'path'=> __DIR__ . '/../../HcbTranslations/language',
                    'mo' => '%s.mo',
                    'pot' => __DIR__ . '/../../HcbTranslations/language/messages.pot'
                )
            )
        )
    ),

    'huskycms' => array(
        'hc-backend'=> array(
            'packages' => array(
                'hcb-translations' => array(
                    'js'=>array(
                        'type'=>'content',
                        'http_path'=>'/js/src/hcb-translations'
                    )
                )
            )
        )
    ),

    'view_manager' => array(
        'strategies' => array(
            'Zf2Libs\View\Strategy\UploaderStrategy'
        )
    )
);
