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
    public function getActiveFaqQuestionCollectionAction(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->getFacade()->findActiveQuestionsWithRelations($questionCollectionTransfer);
    }

    public function getOneFaqQuestionAction(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        return $this->getFacade()->findQuestionById($questionTransfer);
    }
    public function createQuestionAction(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        return $this->getFacade()->saveQuestion($questionTransfer);
    }

    /**
     * Logic should be the same. Uses findOneOrCreate, so it should work either way :)
     * @param FaqQuestionTransfer $questionTransfer
     * @return FaqQuestionTransfer
     */
    public function updateQuestionAction(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        return $this->getFacade()->saveQuestion($questionTransfer);
    }
    public function deleteQuestionAction(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        return $this->getFacade()->deleteQuestion($questionTransfer);
    }
}
