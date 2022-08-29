<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Elasticsearch\Endpoints\Security\Authenticate;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method FaqCommunicationFactory getFactory()
 * @method FaqFacadeInterface getFacade()
 */
class CreateController extends AbstractController
{
    public function indexAction(Request $request)
    {
        $transfer = new FaqQuestionTransfer();
        $faqQuestionForm = $this->getFactory()->createFaqQuestionForm($transfer)->handleRequest($request);


        if ($faqQuestionForm->isSubmitted() && $faqQuestionForm->isValid()) {
            /**
             * @var FaqQuestionTransfer $questionTransfer
             */
            $questionTransfer = $faqQuestionForm->getData();
            $currentUser = $this->getFactory()->getUserFacade()->getCurrentUser();
            $questionTransfer->setFkIdUser($currentUser->getIdUser());
            $result = $this->getFacade()->saveQuestion($questionTransfer);
            if (!$result) {
                $this->addErrorMessage("Sth went wrong! I need to change sth maybe");
            } else {
                $this->addSuccessMessage("Question was added successfully!");
            }
            return $this->redirectResponse('/faq');
        }

        return $this->viewResponse([
            'faqQuestionForm' => $faqQuestionForm->createView()
        ]);
    }
}
