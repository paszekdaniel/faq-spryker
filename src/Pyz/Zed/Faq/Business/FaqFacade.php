<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FaqBusinessFactory getFactory()
 */
class FaqFacade extends AbstractFacade implements FaqFacadeInterface
{

    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer
    {
        return $this->getFactory()->getFaqWriterHandler()->createFaqQuestion($transfer);
    }
}
