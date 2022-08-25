<?php

namespace Pyz\Zed\Faq\Communication\Controller;
use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\FaqTempConfig;
use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method FaqFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    public function indexAction(Request $request) {
//        $transfer = new FaqQuestionTransfer();
//        $transfer->setQuestion("testing question");
//        $transfer->setAnswer("my answer");
//        $transfer->setState(FaqTempConfig::ACTIVE_STATE);
//        $transfer->setFkIdUser(1);
//
//        $translation = new FaqTranslationTransfer();
//        $translation->setLanguage("AT");
//        $translation->setTranslatedQuestion("ich bin da");
//        $translation->setTranslatedAnswer("JAAAAAAAAAAA ja yep");
//
//        $transfer->addTranslation($translation);
//
//        $vote = new FaqVotesTransfer();
//        $vote->setVote(FaqTempConfig::VOTE_UP);
//        $vote->setFkIdCustomer(1);
//
//        $transfer->addVote($vote);
//        $transfer = $this->getFacade()->saveQuestion($transfer);
        $transfer = new FaqQuestionCollectionTransfer();
        $transfer = $this->getFacade()->findActiveQuestions($transfer);
        dd($transfer);
    }
}
