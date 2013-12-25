<?php
namespace HcbTranslations\Service\Translations;

use HcbTranslations\Data\Translations\CreateInterface;
use HcBackend\Service\CommandInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements CommandInterface
{
    /**
     * @var CreateInterface
     */
    protected $data;

    /**
     * @var CreateService
     */
    protected $service;

    public function __construct(CreateInterface $data,
                                CreateService $service)
    {
        $this->data = $data;
        $this->service = $service;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        return $this->service->create($this->data);
    }
}
