<?php

namespace Pyz\Zed\FaqSearch\Communication\Plugin\Event\Subscriber;

use Pyz\Zed\Faq\Dependency\FaqEvents;
use Pyz\Zed\FaqSearch\Communication\Plugin\Event\Listener\FaqSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class FaqSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{

    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(FaqEvents::ENTITY_PYZ_FAQ_QUESTION_CREATE, new FaqSearchListener());
        $eventCollection->addListenerQueued(FaqEvents::ENTITY_PYZ_FAQ_QUESTION_UPDATE, new FaqSearchListener());
        $eventCollection->addListenerQueued(FaqEvents::ENTITY_PYZ_FAQ_QUESTION_DELETE, new FaqSearchListener());
        return $eventCollection;
    }
}
