<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqZedStub implements FaqZedStubInterface
{
    protected ZedRequestClientInterface $zedRequestClient;

    public function __construct(ZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    public function getActiveQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        /**
         * @var FaqQuestionCollectionTransfer $questionCollectionTransfer
         */
        $questionCollectionTransfer = $this->zedRequestClient->call('/faq/gateway/get-active-faq-question-collection', $questionCollectionTransfer);

        return $questionCollectionTransfer;
    }

    public function postVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer
    {
        /**
         * @var FaqVoteTransfer $voteTransfer
         */
        $voteTransfer = $this->zedRequestClient->call('/faq/gateway/create-vote', $voteTransfer);

        return $voteTransfer;
    }
}
