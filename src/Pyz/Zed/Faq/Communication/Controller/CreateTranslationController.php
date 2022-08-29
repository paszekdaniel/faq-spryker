<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
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
        $transfer = new FaqQuestionTransfer();
        $id = $this->castId($request->query->get("id"));
        $dataProvider = $this->getFactory()->createQuestionTranslationDataProvider();
        $faqQuestionForm = $this->getFactory()->createQuestionTranslationForm($dataProvider->getData($id), [])->handleRequest($request);

        if ($faqQuestionForm->isSubmitted() && $faqQuestionForm->isValid()) {
            dd("Submited");
        }
        return $this->viewResponse([
            'faqQuestionForm' => $faqQuestionForm->createView()
        ]);
    }
}
