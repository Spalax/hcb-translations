<?php
namespace HcbTranslationsTest\Data\Translations;

use Doctrine\Common\Collections\ArrayCollection;
use HcbTranslations\Data\Translations\Create;
use Zend\Di\Di;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $extractor;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $fetchService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $translator;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $arrayCollection;

    /**
     * Prepare the objects to be tested.
     */
    protected function setUp()
    {
        $this->request = $this->getMock('\Zend\Http\PhpEnvironment\Request');
        $this->extractor = $this->getMock('HcBackend\Stdlib\Extractor\Request\Payload\Extractor',
                                          array(), array(), '', false);

        $this->fetchService = $this->getMock('HcbTranslations\Service\Translations\Translation\Modules\FetchService',
                                             array(), array(), '', false);

        $this->arrayCollection = $this->getMock('Doctrine\Common\Collections\ArrayCollection');

        $this->fetchService->expects($this->once())
             ->method('fetch')
             ->will($this->returnValue($this->arrayCollection));

        $this->translator = $this->getMock('\Zend\I18n\Translator\Translator');
        $this->translator->expects($this->any())->method('translate')->will($this->returnArgument(0));
    }

    public function testIsValidData()
    {
        $this->extractor->expects($this->once())->method('extract')
             ->will($this->returnValue(array('code'=> 'he', 'module'=>'backend')));

        $this->arrayCollection->expects($this->once())->method('contains')->will($this->returnValue(true));

        $this->fetchService->expects($this->once())
                     ->method('fetch')
                     ->will($this->returnValue($this->arrayCollection));

        $createData = new Create($this->request, $this->extractor,
                                 $this->fetchService, $this->translator, new Di());

        $this->assertTrue($createData->isValid());

        $this->assertEquals('backend', $createData->getModule());
        $this->assertEquals('he', $createData->getCode());
        $this->assertEquals(array(), $createData->getMessages());
    }


    public function testInvalidModule()
    {
        $this->extractor->expects($this->once())->method('extract')
            ->will($this->returnValue(array('code'=> 'he', 'module'=>'backend')));

        $this->arrayCollection->expects($this->once())->method('contains')->will($this->returnValue(false));

        $createData = new Create($this->request, $this->extractor,
                                 $this->fetchService, $this->translator, new Di());

        $this->assertFalse($createData->isValid());
        $this->assertArrayHasKey('module', $createData->getMessages());
    }

    public function testInvalidCode()
    {
        $this->extractor->expects($this->once())->method('extract')
             ->will($this->returnValue(array('code'=> 'hendi', 'module'=>'backend')));

        $this->arrayCollection->expects($this->once())
             ->method('contains')->will($this->returnValue(true));

        $createData = new Create($this->request, $this->extractor,
                                 $this->fetchService, $this->translator,
                                 new Di());

        $this->assertFalse($createData->isValid());
        $this->assertArrayHasKey('code', $createData->getMessages());
    }
}
