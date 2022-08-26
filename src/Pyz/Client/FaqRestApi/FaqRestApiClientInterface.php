<?php

namespace Pyz\Client\FaqRestApi;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;

interface FaqRestApiClientInterface
{
    public function getFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;
    public function getOneFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function createFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function updateFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;
    public function deleteFaqQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

}
