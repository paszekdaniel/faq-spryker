<?php

namespace Pyz\Client\FaqRestApi\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqRestApiZedStubInterface
{
    public function getActiveQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function getOneQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function createQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function updateQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function deleteQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function createFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;
    public function updateFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;
    public function deleteFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer;
}
