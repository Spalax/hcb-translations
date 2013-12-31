<?php
namespace HcbTranslations\Data\Translations;

use HcBackend\Data\DataMessagesInterface;
use HcbTranslations\Service\Translations\Translation\Modules\FetchService;
use HcBackend\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zend\Validator\Callback;
use Zf2Libs\Data\AbstractInputFilter;

class Create extends AbstractInputFilter implements CreateInterface, DataMessagesInterface
{
    /**
     * @var Translator
     */
    protected $translate;

    /**
     * @var array
     */
    protected $clientsEntities = array();

    /**
     * @param Request $request
     * @param Extractor $requestExtractor
     * @param FetchService $fetchService
     * @param Translator $translator
     * @param Di $di
     */
    public function __construct(Request $request,
                                Extractor $requestExtractor,
                                FetchService $fetchService,
                                Translator $translator,
                                Di $di)
    {
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'code'));
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach($di->get('Zend\Validator\StringLength', array('options'=>array('min'=>2, 'max'=>5))))
              ->attach($di->get('Zend\Validator\Regex', array('pattern'=>'/^[a-z]{2}(-[A-Z]{2})?$/')));

        $input->getFilterChain()
              ->attach($di->get('Zend\Filter\StringToLower'));

        $this->add($input);


        $input = $di->get('Zend\InputFilter\Input', array('name'=>'module'));
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach($di->get('Zend\Validator\Callback',
                       array('options'=>array('callback'=>function ($value) use ($fetchService) {
                                return $fetchService->fetch()->contains($value);
                            }))));
        $this->add($input);

        $this->translate = $translator;
        $this->setData($requestExtractor->extract($request));
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->getValue('module');
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->getValue('code');
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $invalidInputs = $this->getInvalidInput();

        $messages = array();
        if (array_key_exists('module', $invalidInputs)) {
            $messages['module'] = $this->translate->translate('Incorrect module defined for translation');
        }

        if (array_key_exists('code', $invalidInputs)) {
            $messages['code'] = $this->translate->translate('Incorrect language code given');
        }

        return $messages;
    }
}
