<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqZedStubInterface
{
    public function getActiveQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function postVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;
}
