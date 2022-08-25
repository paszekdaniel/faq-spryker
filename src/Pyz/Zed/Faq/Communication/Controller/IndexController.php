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
//        $transfer->setState(FaqTempConfig::INACTIVE_STATE);
//        $transfer->setIdQuestion(4);
//        $transfer->setFkIdUser(1);
//        $transfer->setQuestion("Yep");
//        $transfer->setAnswer("No");
//        $this->getFacade()->saveQuestion($transfer);
//
//        $translation = new FaqTranslationTransfer();
//        $translation->setLanguage("PL");
//        $translation->setTranslatedQuestion("jej adas");
//        $translation->setTranslatedAnswer("kukułka");
//        $translation->setFkIdQuestion(1);
//        $this->getFacade()->saveTranslation($translation);
//
//        $transfer->addTranslation($translation);
//
//        $vote = new FaqVotesTransfer();
//        $vote->setVote(FaqTempConfig::VOTE_UP);
//        $vote->setFkIdCustomer(5);
//        $vote->setFkIdQuestion(1);
//        $this->getFacade()->saveVote($vote);

//
//        $transfer->addVote($vote);
//        $transfer = $this->getFacade()->saveQuestion($transfer);
        $transfer = new FaqQuestionCollectionTransfer();
        $transfer = $this->getFacade()->findActiveQuestions($transfer);
        dd($transfer);
    }
}
