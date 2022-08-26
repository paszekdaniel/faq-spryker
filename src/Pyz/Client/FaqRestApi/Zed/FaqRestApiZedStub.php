<?php

namespace Pyz\Client\FaqRestApi\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqRestApiZedStub implements FaqRestApiZedStubInterface
{
    protected ZedRequestClientInterface $zedRequestClient;

    public function __construct(ZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    public function getQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        /**
         * @var FaqQuestionCollectionTransfer $questionCollectionTransfer
         */
        $questionCollectionTransfer = $this->zedRequestClient->call('/faq/gateway/get-faq-question-collection', $questionCollectionTransfer);

        return $questionCollectionTransfer;
    }

    public function getOneQuestion(FaqQuestionTransfer $questionTransfer
    ): FaqQuestionTransfer {
        /**
         * @var FaqQuestionTransfer $questionTransfer
         */
        $questionTransfer = $this->zedRequestClient->call('/faq/gateway/get-one-faq-question', $questionTransfer);

        return $questionTransfer;
    }
}
