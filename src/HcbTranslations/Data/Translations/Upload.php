<?php
namespace HcbTranslations\Data\Translations;

use HcBackend\Data\DataMessagesInterface;
use HcBackend\Data\Exception\DomainException;
use HcbTranslations\Options\ModuleOptions;
use Zend\Di\Di;

use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zend\Validator\File\Extension;
use Zend\Validator\File\MimeType;
use Zf2Libs\Data\AbstractInputFilter;

class Upload extends AbstractInputFilter implements UploadInterface, DataMessagesInterface
{
    /**
     * @var Translator
     */
    protected $translate;

    /**
     * @var array
     */
    protected $jsFileValue = array();

    /**
     * @var array
     */
    protected $poFileValue = array();

    /**
     * @param Request $request
     * @param Translator $translator
     * @param ModuleOptions $options
     * @param Di $di
     */
    public function __construct(Request $request,
                                Translator $translator,
                                ModuleOptions $options,
                                Di $di)
    {
        $input = $di->get('Zend\InputFilter\FileInput', array('jsFile'));
        $input->setAllowEmpty(true);
        $input->setRequired(false);
        $input->getValidatorChain()
              ->attach(new MimeType(array('text/plain')))
              ->attach(new Extension('js'));

        $input->getFilterChain()
              ->attach($di->get('Zend\Filter\File\RenameUpload', array(array(
                   "target"    => realpath($options->getLangTemporaryPath()).'/js',
                   "use_upload_extension" => true,
                   "randomize" => true
              ))));

        $this->add($input);

        $input = $di->get('Zend\InputFilter\FileInput', array('poFile'));
        $input->setAllowEmpty(true);
        $input->setRequired(false);
        $input->getValidatorChain()
              ->attach(new MimeType(array('text/x-po')))
              ->attach(new Extension('po'));

        $input->getFilterChain()
            ->attach($di->get('Zend\Filter\File\RenameUpload', array(array(
                "target"    => realpath($options->getLangTemporaryPath()).'/po',
                "use_upload_extension" => true,
                "randomize" => true
            ))));

        $this->add($input);

        $this->translate = $translator;

        $this->setData(array_merge_recursive($request->getPost()->toArray(),
                                             $request->getFiles()->toArray()));
    }

    /**
     * @param string $name
     * @return string
     * @throws \HcbTranslations\Data\Exception\DomainException
     */
    private function getTmpName($name)
    {
        $result = $this->getValue($name);
        if (!array_key_exists('tmp_name', $result)) {
            throw new DomainException("Could not found tmp_name key in result of uploaded $name file");
        }
        return $result['tmp_name'];
    }

    /**
     * @return string
     */
    public function getJsFile()
    {
        return $this->getTmpName('jsFile');
    }

    /**
     * @return bool
     */
    public function hasJsFile()
    {
        return !!count($this->getValue('jsFile'));
    }

    /**
     * @return bool
     */
    public function hasPoFile()
    {
        return !!count($this->getValue('poFile'));
    }

    /**
     * @return string
     */
    public function getPoFile()
    {
        return $this->getTmpName('poFile');
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $invalidInputs = $this->getInvalidInput();

        $messages = array();
        if (array_key_exists('jsFile', $invalidInputs)) {
            $messages['jsFile'] = $this->translate->translate('Incorrect JS file given');
        }

        if (array_key_exists('poFile', $invalidInputs)) {
            $messages['poFile'] = $this->translate->translate('Incorrect PO file given');
        }

        return $messages;
    }
}
