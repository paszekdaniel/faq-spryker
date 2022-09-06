<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqClientInterface
{
    public function getActiveFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function postVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;
    public function getFaqQuestionFromSearchById(string $idQuestion): array;
}
