<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;

interface FaqFacadeInterface
{
    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
}
