<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionTransfer;

interface FaqFacadeInterface
{
    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;
}
