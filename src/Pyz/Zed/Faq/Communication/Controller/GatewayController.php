<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method FaqFacadeInterface getFacade()
 */

class GatewayController extends AbstractGatewayController
{
    public function getFaqQuestionCollectionAction(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->getFacade()->findAllQuestionsWithRelations($questionCollectionTransfer);
    }

    public function getOneFaqQuestionAction(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        return $this->getFacade()->findQuestionById($questionTransfer);
    }
}
