<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqFacadeInterface
{
    /**
     * Saves cascade, votes and translations associated with question will be saved to!
     * @param FaqQuestionTransfer $transfer
     * @return FaqQuestionTransfer
     */
    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Automatically translates questions based on locale
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Automatically translates questions based on locale
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function saveTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    public function saveVote(FaqVoteTransfer $votesTransfer): FaqVoteTransfer;

    /**
     * Automatically translates questions based on locale
     * @param FaqQuestionTransfer $questionTransfer
     * @return FaqQuestionTransfer
     */
    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function deleteQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function deleteVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;

    public function deleteTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    public function findAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer;

    public function findVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;
}
