<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Entity\Translation;

class HandlerAggregator implements HandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = array();

    /**
     * @param HandlerInterface $handler
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * @param Translation $translationEntity
     * @return bool
     */
    public function handle(Translation $translationEntity)
    {
        foreach ($this->handlers as $handler) {
            if (!$handler->handle($translationEntity)) {
                return false;
            }
        }

        return true;
    }
}
