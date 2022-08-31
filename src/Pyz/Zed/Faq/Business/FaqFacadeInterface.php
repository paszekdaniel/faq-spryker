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
     * Specification:
     * - Save cascade votes and translations associated with question when provided
     * - Uses findOneOrCreate, so it can update too
     * @param FaqQuestionTransfer $transfer
     * @return FaqQuestionTransfer
     */
    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    /**
     * Specification:
     * - fetches all questions from db
     * - doesn't count votes, because they are not provided
     * - doesn't translate it, because translations are not provided
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Specification:
     * - fetches questions where they have state = FaqConfig::STATE_ACTIVE from db
     * - doesn't count votes, because they are not provided
     * - doesn't translate it, because translations are not provided
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Specification:
     * - fetches all questions from db with votes and relations
     * - counts votes
     * - translates question, based on current locale
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Specification:
     * - fetches questions from db with votes and relations where state = FaqConfig::STATE_ACTIVE
     * - counts votes
     * - translates question, based on current locale
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @return FaqQuestionCollectionTransfer
     */
    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    /**
     * Specification:
     * - saves translation
     * - uses findOneOrCreate, so it can update too
     * @param FaqTranslationTransfer $translationTransfer
     * @return FaqTranslationTransfer
     */
    public function saveTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    /**
     * Specification:
     * - saves vote
     * - uses findOneOrCreate, so it can update too
     * @param FaqVoteTransfer $votesTransfer
     * @return FaqVoteTransfer
     */
    public function saveVote(FaqVoteTransfer $votesTransfer): FaqVoteTransfer;

    /**
     * Specification:
     * - fetches with relations
     * - translates it
     * - counts votes
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
