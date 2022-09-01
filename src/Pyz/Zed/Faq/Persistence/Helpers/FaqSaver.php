<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Orm\Zed\Faq\Persistence\PyzFaqTranslationQuery;
use Orm\Zed\Faq\Persistence\PyzFaqVote;
use Orm\Zed\Faq\Persistence\PyzFaqVoteQuery;

class FaqSaver
{
//    add types
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
    public function saveQuestionEntityCascade(FaqQuestionTransfer $transfer,  PyzFaqQuestionQuery $query ): FaqQuestionTransfer
    {
        $questionEntity = $query
            ->filterByIdQuestion($transfer->getIdQuestion())
            ->findOneOrCreate();
        //propel cascade uses primary key(question_id) which isn't generated yet, because it isn't saved yet!!

        /**
         * @var $transfer FaqQuestionTransfer
         */
        $transfer = $this->mapAndSave($transfer, $questionEntity) ;

        //no associated objects where passed alongside
        if($transfer->getTranslations()->count() === 0 && $transfer->getVotes()->count() === 0) {
            return $transfer;
        }
//        It has to be this way because propel ignores adding by same PK
//        So I can't edit translation by addPyzFaqTranslation
//        I check if I change this, if so then I modify it, then I attach a new one whether I did that or not,
//        because propel will ignore unnecessary adding
//        TODO: map existing question to language => translation key value pairs, to fix O(n^2)
        foreach ($transfer->getTranslations() as $translation) {
            $translation->setFkIdQuestion($transfer->getIdQuestion());
            foreach ($questionEntity->getPyzFaqTranslations() as $translationEntity) {
                if($translationEntity->getLanguage() === $translation->getLanguage()) {
                    $translationEntity->fromArray($translation->toArray());
                }
            }
            $tempEntity = (new PyzFaqTranslation())->fromArray($translation->toArray());
//            it adds IF primary key is different from the ones that it already has
            $questionEntity->addPyzFaqTranslation($tempEntity);
        }

        // attach votes
//        See attach translations
        foreach ($transfer->getVotes() as $vote) {
            $vote->setFkIdQuestion($transfer->getIdQuestion());
            foreach ($questionEntity->getPyzFaqVotes() as $voteEntity) {
                if($voteEntity->getFkIdCustomer() === $vote->getFkIdCustomer()) {
                    $voteEntity->fromArray($vote->toArray());
                }
            }
            $tempEntity = (new PyzFaqVote())->fromArray($vote->toArray());
            $questionEntity->addPyzFaqVote($tempEntity);
        }
//        to save relations. Actual object shouldn't do query, because it's clean.

        $rows=$questionEntity->save();
        return $transfer;
    }
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTranslationEntity(FaqTranslationTransfer $transfer,  PyzFaqTranslationQuery $query ): FaqTranslationTransfer
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
    public function saveVoteEntity(FaqVoteTransfer $transfer, PyzFaqVoteQuery $query): FaqVoteTransfer {
        $voteEntity = $query
            ->filterByFkIdQuestion($transfer->getFkIdQuestion())
            ->filterByFkIdCustomer($transfer->getFkIdCustomer())
            ->findOneOrCreate();
        return $this->mapAndSave($transfer, $voteEntity);
    }
}
