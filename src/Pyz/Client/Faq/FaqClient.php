<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqFactory getFactory()
 */
class FaqClient extends AbstractClient implements FaqClientInterface
{

    public function getActiveFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->createFaqZedStub()->getActiveQuestionCollection($questionCollectionTransfer);
    }
}
