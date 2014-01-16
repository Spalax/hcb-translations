<?php
return array(
    'HcbTranslations-Controller-Resource' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Translations\Translation\Extractor'
        )
    ),

    'HcbTranslations-Controller-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' => 'HcbTranslations\Service\Translations\FetchQbBuilderService',
            'viewModel' => 'HcbTranslations-PaginatorViewModel'
        )
    ),

    'HcbTranslations-Controller-Modules-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbTranslations\Service\Translations\Translation\Modules\FetchService',
            'viewModel' => 'HcbTranslations-Module-PaginatorViewModel'
        )
    ),

    'HcbTranslations-Controller-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Translations\Create',
            'serviceCommand' => 'HcbTranslations\Service\Translations\CreateCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'HcbTranslations-Controller-Resource-Delete' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'serviceCommand' => 'HcbTranslations\Service\Translations\Translation\DeleteCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    ),

    'HcbTranslations-Controller-Resource-File-Upload' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Translations\Translation\Upload',
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'serviceCommand' => 'HcbTranslations\Service\Translations\Translation\UploadCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Uploader\Specific\StatusMessageDataModelFactory'
        )
    ),

    'HcbTranslations-Controller-Resource-Download' => array(
        'parameters' => array(
            'fetchService' => 'HcbTranslations\Service\Translations\Translation\FetchService',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    )
);
