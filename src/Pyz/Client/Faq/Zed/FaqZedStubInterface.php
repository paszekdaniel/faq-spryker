<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;

interface FaqZedStubInterface
{
    public function getActiveQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
}
