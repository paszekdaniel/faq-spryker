<?php

namespace Pyz\Zed\Faq\Business\Model;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;

class FaqDeleterHandler
{
    private FaqEntityManagerInterface $entityManager;

    /**
     * @param FaqEntityManagerInterface $entityManager
     */
    public function __construct(FaqEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function deleteQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer
    {
        return $this->entityManager->deleteQuestionEntityByPrimaryKey($transfer);
    }

    public function deleteTranslation(FaqTranslationTransfer $transfer): FaqTranslationTransfer
    {
        return $this->entityManager->deleteTranslationEntityByPrimaryKey($transfer);
    }

    public function deleteVote(FaqVoteTransfer $transfer): FaqVoteTransfer
    {
        return $this->entityManager->deleteVoteEntityByPrimaryKey($transfer);
    }
}
