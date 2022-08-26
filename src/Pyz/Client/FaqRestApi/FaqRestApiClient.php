<?php

namespace Pyz\Client\FaqRestApi;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqRestApiFactory getFactory()
 */
class FaqRestApiClient extends AbstractClient implements FaqRestApiClientInterface
{
    public function getFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->createFaqZedStub()->getQuestionCollection($questionCollectionTransfer);
    }

    public function getOneFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
        return $this->getFactory()->createFaqZedStub()->getOneQuestion($questionTransfer);
    }
}
