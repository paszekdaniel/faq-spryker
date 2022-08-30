<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FaqBusinessFactory getFactory()
 */
class FaqFacade extends AbstractFacade implements FaqFacadeInterface
{

    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer
    {
        return $this->getFactory()->getFaqWriterHandler()->createFaqQuestion($transfer);
    }

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->getFaqReaderHandler()->findAllQuestions($questionCollectionTransfer);
    }

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->getFaqReaderHandler()->findActiveQuestions($questionCollectionTransfer);
    }

    public function saveTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer
    {
        return $this->getFactory()->getFaqWriterHandler()->createFaqTranslation($translationTransfer);
    }

    public function saveVote(FaqVoteTransfer $votesTransfer): FaqVoteTransfer
    {
        return $this->getFactory()->getFaqWriterHandler()->createFaqVote($votesTransfer);
    }

    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->getFaqReaderHandler()->findAllQuestionsWithRelations($questionCollectionTransfer);
    }

    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->getFaqReaderHandler()->findActiveQuestionsWithRelations($questionCollectionTransfer);
    }

    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->getFaqReaderHandler()->findQuestionById($questionTransfer);
    }

    public function deleteQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->getFaqDeleterHandler()->deleteQuestion($questionTransfer);
    }

    public function deleteVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer
    {
        return $this->getFactory()->getFaqDeleterHandler()->deleteVote($voteTransfer);
    }

    public function deleteTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer
    {
        return $this->getFactory()->getFaqDeleterHandler()->deleteTranslation($translationTransfer);
    }
    public function findAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer
    {
        return $this->getFactory()->getFaqReaderHandler()->findAllVotes($collectionTransfer);
    }
    public function findVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer
    {
        return $this->getFactory()->getFaqReaderHandler()->findVoteByKey($voteTransfer);
    }
}
