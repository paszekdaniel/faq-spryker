<?php

namespace Pyz\Client\FaqRestApi\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;

interface FaqRestApiZedStubInterface
{
    public function getQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function getOneQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
}
