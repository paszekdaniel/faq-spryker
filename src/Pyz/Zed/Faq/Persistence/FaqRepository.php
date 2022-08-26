<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\FaqConfig;
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
        $questionsEntities->populateRelation('PyzFaqVote');
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
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->filterByState(FaqConfig::ACTIVE_STATE)->find();
        $questionsEntities->populateRelation('PyzFaqTranslation');
        $questionsEntities->populateRelation('PyzFaqVote');

        $transfer = new FaqQuestionCollectionTransfer();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($transfer, $questionsEntities, true);
    }

    /**
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        $questionsEntities = $this->getFactory()->createFaqQuestionQuery()->filterByState(FaqConfig::ACTIVE_STATE)->find();
        return FaqMapper::mapQuestionCollectionEntityToTransferCollection($questionCollectionTransfer, $questionsEntities);
    }

    /**
     * TODO: 3 queries!!! fix it
     * @param FaqQuestionTransfer $questionTransfer
     * @return FaqQuestionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer
    {
//        TODO: 3 queries!!! fix it
        $question = $this->getFactory()->createFaqQuestionQuery()->filterByIdQuestion($questionTransfer->getIdQuestion())->findOne();
        $question->getPyzFaqTranslations();
        $question->getPyzFaqVotes();

        $questionTransfer = new FaqQuestionTransfer();
        if(!$question) {
            return $questionTransfer;
        }
        $questionTransfer = FaqMapper::mapQuestionEntityToTransfer($questionTransfer, $question, true);
        return $questionTransfer;
    }
}
