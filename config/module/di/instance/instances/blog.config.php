<?php
return array(
    'Collection-Blog-Posts-Post' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Blog\Posts\Post\FetchService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Blog\Posts\Post\Extractor'
        )
    ),

    'Collection-Blog-Posts-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbTranslations\Service\Blog\Posts\FetchQbBuilderService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Blog\Posts\Post\Extractor'
        )
    ),

    'Collection-Blog-Posts-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Blog\Posts\Create',
            'serviceCommand' => 'HcbTranslations\Service\Blog\Posts\CreateCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'Collection-Blog-Posts-Post-Delete' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Blog\Posts\Post\FetchService',
            'serviceCommand' => 'HcbTranslations\Service\Blog\Posts\Post\DeleteCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    )
);
