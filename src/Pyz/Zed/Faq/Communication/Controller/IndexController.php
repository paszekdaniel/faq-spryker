<?php

namespace Pyz\Zed\Faq\Communication\Controller;
use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\FaqConfig;
use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method FaqFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    public function indexAction(Request $request) {
        $transfer = new FaqQuestionTransfer();
        $transfer->setState(FaqConfig::INACTIVE_STATE);
        $transfer->setIdQuestion(4);
        $transfer->setFkIdUser(1);
        $transfer->setQuestion("Yep");
        $transfer->setAnswer("Nooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo");
        $this->getFacade()->saveQuestion($transfer);
//
//        $translation = new FaqTranslationTransfer();
//        $translation->setLanguage("PL");
//        $translation->setTranslatedQuestion("jej adas");
//        $translation->setTranslatedAnswer("kukułka");
//        $translation->setFkIdQuestion(1);
//        $this->getFacade()->saveTranslation($translation);
//
//        $transfer->addTranslation($translation);

//        $vote = new FaqVoteTransfer();
//        $vote->setVote(FaqConfig::VOTE_UP);
//        $vote->setFkIdCustomer(4);
//        $vote->setFkIdQuestion(2);
//        $this->getFacade()->saveVote($vote);
//        dd($vote);

//
//        $transfer->addVote($vote);
//        $transfer = $this->getFacade()->saveQuestion($transfer);
        $transfer = new FaqQuestionCollectionTransfer();
////        $transfer = $this->getFacade()->findActiveQuestionsWithRelations($transfer);
////        $transfer->getQuestions()->count();
//
//        $transfer = new FaqQuestionTransfer();
//        $transfer->setIdQuestion(1);
        $transfer = $this->getFacade()->findActiveQuestionsWithRelations($transfer);
        dd($transfer);
    }
}
