<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Orm\Zed\Faq\Persistence\PyzFaqVotes;

class FaqSaver
{
//    add types :)
    private function mapAndSave($transfer, $entity)
    {
        $entity->fromArray($transfer->toArray());
        $entity->save();
        $transfer->fromArray($entity->toArray());
        return $transfer;
    }
    /**
     * Can save cascade votes and translations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveQuestionEntityCascade(FaqQuestionTransfer $transfer,  \Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery $query ): FaqQuestionTransfer
    {
        $questionEntity = $query
            ->filterByIdQuestion($transfer->getIdQuestion())
            ->findOneOrCreate();
        //propel cascade uses primary key(question_id) which isn't generated yet, because it isn't saved yet!!

        /**
         * @var $transfer FaqQuestionTransfer
         */
        $transfer = $this->mapAndSave($transfer, $questionEntity) ;
        //no associated objects where passed
        //no isEmpty() like in entity :(
        if($transfer->getTranslations()->count() === 0 && $transfer->getVotes()->count() === 0) {
            return $transfer;
        }
        // attach translations
        foreach ($transfer->getTranslations() as $translation) {
            $translation->setFkIdQuestion($transfer->getIdQuestion());
            $tempEntity = (new PyzFaqTranslation())->fromArray($translation->toArray());
            $questionEntity->addPyzFaqTranslation($tempEntity);
        }
        // attach votes
        foreach ($transfer->getVotes() as $vote) {
            $vote->setFkIdQuestion($transfer->getIdQuestion());
            $tempEntity = (new PyzFaqVotes())->fromArray($vote->toArray());
            $questionEntity->addPyzFaqVotes($tempEntity);
        }
//        to save relations. Actual object shouldn't do query, because it's clean.
        $questionEntity->save();
        return $transfer;
    }
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTranslationEntity(FaqTranslationTransfer $transfer,  \Orm\Zed\Faq\Persistence\PyzFaqTranslationQuery $query ): FaqTranslationTransfer
    {
        $translationEntity = $query
            ->filterByFkIdQuestion($transfer->getFkIdQuestion())
            ->filterByLanguage($transfer->getLanguage())
            ->findOneOrCreate();

        return $this->mapAndSave($transfer, $translationEntity);
    }
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveVoteEntity(FaqVoteTransfer $transfer, \Orm\Zed\Faq\Persistence\PyzFaqVotesQuery $query): FaqVoteTransfer {
        $voteEntity = $query
            ->filterByFkIdQuestion($transfer->getFkIdQuestion())
            ->filterByFkIdCustomer($transfer->getFkIdCustomer())
            ->findOneOrCreate();

        return $this->mapAndSave($transfer, $voteEntity);
    }
}
