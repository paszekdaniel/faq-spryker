<?php

namespace Pyz\Zed\Faq\Business\Model;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;

class FaqReaderHandler
{
    private FaqRepositoryInterface $repo;

    public function __construct(FaqRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->repo->findAllQuestions($questionCollectionTransfer);
    }
    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->repo->findAllQuestionsWithRelations($questionCollectionTransfer);
    }
}
