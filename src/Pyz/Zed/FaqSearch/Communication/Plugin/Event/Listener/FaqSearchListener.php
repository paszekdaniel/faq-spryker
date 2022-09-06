<?php

namespace Pyz\Zed\FaqSearch\Communication\Plugin\Event\Listener;

use Generated\Shared\Transfer\EventEntityTransfer;
use Pyz\Zed\Faq\Dependency\FaqEvents;
use Pyz\Zed\FaqSearch\Business\FaqSearchFacadeInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method FaqSearchFacadeInterface getFacade()
 */
class FaqSearchListener extends AbstractPlugin implements EventHandlerInterface
{

    public function handle(TransferInterface $transfer, $eventName)
    {
        /**
         * @var EventEntityTransfer $transfer
         */
        if($eventName === FaqEvents::ENTITY_PYZ_FAQ_QUESTION_CREATE) {
            $this->getFacade()->publish($transfer->getId());
        }
    }
}
