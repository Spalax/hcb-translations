<?php
namespace HcbTranslations\Data\Translations;

use HcBackend\Data\DataMessagesInterface;
use HcbTranslations\Service\Translations\Translation\Modules\FetchService;
use HcbTranslations\Stdlib\Extractor\Request\Payload\Extractor;
use Doctrine\ORM\QueryBuilder;
use Zend\Filter\StringToLower;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\Json\Json;
use Zend\Validator\Callback as CallbackValidator;
use Zend\Validator\Digits;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
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

    public function __construct(Request $request,
                                Extractor $requestExtractor,
                                FetchService $fetchService,
                                Translator $translator)
    {
        $input = new Input('code');
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach(new StringLength(array('min'=>2, 'max'=>5)))
              ->attach(new Regex('/^[a-z]{2}(-[A-Z]{2})?$/'));

        $input->getFilterChain()
              ->attach(new StringToLower());

        $this->add($input);


        $input = new Input('module');
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach(new CallbackValidator(
                function ($value) use ($fetchService) {
                    return $fetchService->fetch()->contains($value);
                }
              ));
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
