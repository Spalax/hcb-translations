<?php
return array(
    'Collection-Translations-Resource' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Translations\Translation\Extractor'
        )
    ),

    'Collection-Translations-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbTranslations\Service\Translations\FetchQbBuilderService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Translations\Translation\Extractor'
        )
    ),

    'Collection-Translations-Modules-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbTranslations\Service\Translations\Translation\Modules\FetchService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Translations\Translation\Modules\Extractor'
        )
    ),

    'Collection-Translations-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Translations\Create',
            'serviceCommand' => 'HcbTranslations\Service\Translations\CreateCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'Collection-Translations-Resource-Delete' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'serviceCommand' => 'HcbTranslations\Service\Translations\Translation\DeleteCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'Collection-Translations-Resource-File-Upload' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Translations\Translation\Upload',
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'serviceCommand' => 'HcbTranslations\Service\Translations\Translation\UploadCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Uploader\Specific\StatusMessageDataModelFactory'
        )
    ),

    'Collection-Translations-Resource-Download' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    )
);
