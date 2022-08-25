<?php

namespace Pyz\Zed\Faq\Business\Model;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;


class FaqWriterHandler
{
    private FaqEntityManagerInterface $entityManager;

    public function __construct(FaqEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createFaqQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer {
        return $this->entityManager->saveQuestionEntityCascade($transfer);
    }
    public function createFaqTranslation(FaqTranslationTransfer $transfer): FaqTranslationTransfer {
        return $this->entityManager->saveTranslationEntity($transfer);
    }
    public function createFaqVote(FaqVotesTransfer $transfer): FaqVotesTransfer {
        return $this->entityManager->saveVoteEntity($transfer);
    }
}
