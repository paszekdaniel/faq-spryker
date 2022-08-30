<?php

namespace Pyz\Client\FaqRestApi;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqRestApiFactory getFactory()
 */
class FaqRestApiClient extends AbstractClient implements FaqRestApiClientInterface
{
    public function getFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->createFaqZedStub()->getActiveQuestionCollection($questionCollectionTransfer);
    }

    public function getOneFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->createFaqZedStub()->getOneQuestion($questionTransfer);
    }

    public function createFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->createFaqZedStub()->createQuestion($questionTransfer);
    }

    public function updateFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->createFaqZedStub()->updateQuestion($questionTransfer);
    }

    public function deleteFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->createFaqZedStub()->deleteQuestion($questionTransfer);
    }

    public function createFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer
    {
        return $this->getFactory()->createFaqZedStub()->createFaqVote($transfer);
    }

    public function updateFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer
    {
        return $this->getFactory()->createFaqZedStub()->updateFaqVote($transfer);

    }

    public function deleteFaqVote(FaqVoteTransfer $transfer): FaqVoteTransfer
    {
        return $this->getFactory()->createFaqZedStub()->deleteFaqVote($transfer);

    }
}
