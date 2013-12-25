<?php
return array(
    'Collection-Clients-List' => array(
        'parameters' => array(
            'fetchQbBuilderService' => 'HcbTranslations\Service\Clients\FetchQbBuilderService',
            'extractor' => 'HcbTranslations\Stdlib\Extractor\Clients\Extractor'
        )
    ),

    'Collection-Clients-Block' => array(
        'parameters' => array(
            'inputData' => 'HcbTranslations\Data\Clients\Client\Block',
            'serviceCommand' => 'HcbTranslations\Service\Clients\Client\BlockCommand',
            'jsonResponseModelFactory' => 'Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory'
        )
    )
);
