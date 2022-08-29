<?php

namespace Pyz\Client\FaqRestApi\Zed;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;

interface FaqRestApiZedStubInterface
{
    public function getActiveQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function getOneQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function createQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function updateQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function deleteQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
}
