<?php
return array(

    // Controllers
    'HcbTranslations-Controller-Resource' => 'HcBackend\Controller\Common\Collection\ResourceController',

    'HcbTranslations-Controller-List' => 'HcBackend\Controller\Common\Collection\ListController',

    'HcbTranslations-Controller-Modules-List' =>
        'HcBackend\Controller\Common\Collection\ListController',

    'HcbTranslations-Controller-Create' => 'HcBackend\Controller\Common\Collection\DataController',

    'HcbTranslations-Controller-Resource-Delete' =>
        'HcBackend\Controller\Common\Collection\ResourceDeleteController',

    'HcbTranslations-Controller-Resource-File-Upload' =>
        'HcBackend\Controller\Common\Collection\ResourceDataController',

    'HcbTranslations-Controller-Resource-Download' =>
        'HcbTranslations\Controller\Translations\DownloadController',

    'HcbTranslations-Posts-Post-Data-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',

    // Common
    'HcbTranslations-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel',
    'HcbTranslations-Module-PaginatorViewModel' => 'Zf2Libs\Paginator\ViewModel\JsonModel'
);
