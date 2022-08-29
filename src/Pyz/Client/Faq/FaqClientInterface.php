<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;

interface FaqClientInterface
{
    public function getActiveFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

}
