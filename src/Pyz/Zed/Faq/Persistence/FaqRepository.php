<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\FaqTempConfig;
use Pyz\Zed\Faq\Persistence\Helpers\FaqMapper;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method FaqPersistenceFactory getFactory()
 */
class FaqRepository extends AbstractRepository implements FaqRepositoryInterface
{

    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->find();
        $questionsEntities->populateRelation('PyzFaqTranslation');
        $questionsEntities->populateRelation('PyzFaqVotes');
        $transfer = new FaqQuestionCollectionTransfer();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($transfer, $questionsEntities, true);
    }

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->find();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($questionCollectionTransfer, $questionsEntities);
    }

    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->filterByState(FaqTempConfig::ACTIVE_STATE)->find();
        $questionsEntities->populateRelation('PyzFaqTranslation');
        $questionsEntities->populateRelation('PyzFaqVotes');
        $transfer = new FaqQuestionCollectionTransfer();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($transfer, $questionsEntities, true);
    }

    /**
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->filterByState(FaqTempConfig::ACTIVE_STATE)->find();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($questionCollectionTransfer, $questionsEntities);
    }
}
