<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;

class FaqWriterHandler
{
    private FaqEntityManagerInterface $entityManager;

    public function __construct(FaqEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createFaqQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer {
        $transfer = $this->entityManager->saveQuestionEntityCascade($transfer);
        dd($transfer);
        return $transfer;
    }
}
