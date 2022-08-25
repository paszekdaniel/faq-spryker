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
class EditController extends AbstractController
{
    public function indexAction(Request $request)
    {
        $transfer = new FaqQuestionTransfer();
        $id = $this->castId($request->query->get('id'));
        $transfer->setIdQuestion($id);

        $transfer = $this->getFacade()->findQuestionById($transfer);
        $faqQuestionForm = $this->getFactory()->createFaqQuestionForm($transfer)->handleRequest($request);

        if ($faqQuestionForm->isSubmitted() && $faqQuestionForm->isValid()) {
            /**
             * @var FaqQuestionTransfer $questionTransfer
             */
            $questionTransfer = $faqQuestionForm->getData();
//            $questionTransfer->setFkIdUser()
            $result = $this->getFacade()->saveQuestion($questionTransfer);
            if (!$result) {
                $this->addErrorMessage("Sth went wrong! I need to change sth maybe");
            } else {
                $this->addSuccessMessage("Question was updated successfully!");
            }
            return $this->redirectResponse('/faq/list');
        }

        return $this->viewResponse([
            'faqQuestionForm' => $faqQuestionForm->createView()
        ]);
    }

}
