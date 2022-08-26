<?php

namespace Pyz\Zed\Faq\Business\Model;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqBusinessMapper;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class FaqReaderHandler
{
    private FaqRepositoryInterface $repo;
    private LocaleFacadeInterface $localeFacade;

    public function __construct(FaqRepositoryInterface $repo, LocaleFacadeInterface $localeFacade)
    {
        $this->repo = $repo;
        $this->localeFacade = $localeFacade;
    }
    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->repo->findAllQuestions($questionCollectionTransfer);
    }
    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        return $this->repo->findActiveQuestions($questionCollectionTransfer);
    }
    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        $questionCollectionTransfer = $this->repo->findAllQuestionsWithRelations($questionCollectionTransfer);

        $currentLanguage = $this->localeFacade->getCurrentLocaleName();
        foreach ($questionCollectionTransfer->getQuestions() as $question) {
            FaqBusinessMapper::translateQuestion($question, $currentLanguage);
        }
        return $questionCollectionTransfer;
    }
    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer {
        $questionCollectionTransfer = $this->repo->findActiveQuestionsWithRelations($questionCollectionTransfer);
        $currentLanguage = $this->localeFacade->getCurrentLocaleName();
        foreach ($questionCollectionTransfer->getQuestions() as $question) {
            FaqBusinessMapper::translateQuestion($question, $currentLanguage);
        }
        return $questionCollectionTransfer;
    }
    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer {
        $questionTransfer = $this->repo->findQuestionById($questionTransfer);
        $currentLanguage = $this->localeFacade->getCurrentLocaleName();
        return FaqBusinessMapper::translateQuestion($questionTransfer, $currentLanguage);

    }
}
