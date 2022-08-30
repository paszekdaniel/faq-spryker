<?php

namespace Pyz\Client\FaqRestApi;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqRestApiClientInterface
{
    public function getFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function getOneFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function createFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function updateFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function deleteFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function createFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;
    public function updateFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;
    public function deleteFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;

    public function getAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer;
    public function getVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;

}
