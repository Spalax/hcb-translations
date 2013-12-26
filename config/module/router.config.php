<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'translations' => include __DIR__ . '/router/translations.config.php',
            )
        )
    )
);
