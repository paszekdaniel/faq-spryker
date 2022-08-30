<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
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

    /**
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
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
//        TODO: 3 queries!!! fix it?
//        Not sure if it is possible to fetch all 3 at once, because findOne is just limit(1)&find()
//        So there is again problem that with and limit can't be together when there is one-to-many relationship

        $question = $this->getFactory()->createFaqQuestionQuery()
//            ->leftJoinWithPyzFaqTranslation()
//            ->leftJoinWithPyzFaqVote()
            ->filterByIdQuestion($questionTransfer->getIdQuestion())
            ->findOne();

        $questionTransfer = new FaqQuestionTransfer();
        if(!$question) {
            return $questionTransfer;
        }

        $question->getPyzFaqTranslations();
        $question->getPyzFaqVotes();
        $questionTransfer = FaqMapper::mapQuestionEntityToTransfer($questionTransfer, $question, true);
        return $questionTransfer;
    }

    public function findAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer
    {
        $votes = $this->getFactory()->createFaqVotesQuery()
            ->find();
        foreach ($votes as $vote) {
            $transfer = new FaqVoteTransfer();
            $transfer->fromArray($vote->toArray());
            $collectionTransfer->addVote($transfer);
        }
        return $collectionTransfer;
    }

    public function findVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer
    {
        $vote = $this->getFactory()->createFaqVotesQuery()
            ->filterByFkIdCustomer($voteTransfer->getFkIdCustomer())
            ->filterByFkIdQuestion($voteTransfer->getFkIdQuestion())
            ->findOne();

        if(!$vote) {
            return new FaqVoteTransfer();
        }
        return $voteTransfer->fromArray($vote->toArray());
    }
}
