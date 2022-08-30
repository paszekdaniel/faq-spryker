<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Pyz\Zed\Faq\Communication\FaqCommunicationMapper;
use Pyz\Zed\Faq\Communication\QuestionTranslationDataProvider;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqCommunicationFactory getFactory()
 * @method FaqFacadeInterface getFacade()
 */
class CreateTranslationController extends AbstractController
{
    public function indexAction(Request $request)
    {
        $id = $this->castId($request->query->get("id"));
        $dataProvider = $this->getFactory()->createQuestionTranslationDataProvider();
        $data = $dataProvider->getData($id);
        $faqQuestionForm = $this->getFactory()->createQuestionTranslationForm($data, [])->handleRequest($request);

        if ($faqQuestionForm->isSubmitted() && $faqQuestionForm->isValid()) {
            $questionTransfer = FaqCommunicationMapper::mapTranslationFormToQuestionTransfer($faqQuestionForm->getData());
            $currentUser = $this->getFactory()->getUserFacade()->getCurrentUser();
            $questionTransfer->setFkIdUser($currentUser->getIdUser());
            $result = $this->getFacade()->saveQuestion($questionTransfer);
            if (!$result->getIdQuestion()) {
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
