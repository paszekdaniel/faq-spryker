<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqRepositoryInterface
{
    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    /**
     * returns new instance of transfer when not found
     * @param FaqQuestionTransfer $questionTransfer
     * @return FaqQuestionTransfer
     */
    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function findAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer;
    public function findVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;
}
