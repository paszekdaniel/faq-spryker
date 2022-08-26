<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqCommunicationFactory getFactory()
 * @method FaqFacadeInterface getFacade()
 */
class DeleteController extends AbstractController
{
    public function indexAction(Request $request) {
        $transfer = new FaqQuestionTransfer();
        $id = $this->castId($request->query->get('id'));
        $transfer->setIdQuestion($id);

        $this->getFacade()->deleteQuestion($transfer);

        $this->addSuccessMessage("Deleted question");

        return $this->redirectResponse('/faq');
    }
}
