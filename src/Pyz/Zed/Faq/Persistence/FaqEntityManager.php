<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Orm\Zed\Faq\Persistence\PyzFaqVotes;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method FaqPersistenceFactory getFactory()
 */
class FaqEntityManager extends AbstractEntityManager implements FaqEntityManagerInterface
{

    /**
     *
     * Saves cascade votes and translations, when they are attached to transfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveQuestionEntityCascade(FaqQuestionTransfer $transfer): FaqQuestionTransfer
    {
        $query = $this->getFactory()->createFaqQuestionQuery();
        $saver = $this->getFactory()->createFaqSaver();
        return $saver->saveQuestionEntityCascade($transfer, $query);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTranslationEntity(FaqTranslationTransfer $transfer): FaqTranslationTransfer
    {
        $query = $this->getFactory()->createFaqTranslationQuery();
        $saver = $this->getFactory()->createFaqSaver();
        return $saver->saveTranslationEntity($transfer, $query);

    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveVoteEntity(FaqVotesTransfer $transfer): FaqVotesTransfer {
        $query = $this->getFactory()->createFaqVotesQuery();
        $saver = $this->getFactory()->createFaqSaver();
        return $saver->saveVoteEntity($transfer, $query);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteQuestionEntityByPrimaryKey(FaqQuestionTransfer $transfer): FaqQuestionTransfer {
        $entity = new PyzFaqQuestion();
        $entity->setIdQuestion($transfer->getIdQuestion())->delete();
        //return empty???
        return new FaqQuestionTransfer();
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteTranslationEntityByPrimaryKey(FaqTranslationTransfer $transfer): FaqTranslationTransfer {
        $entity = new PyzFaqTranslation();
        $entity->setFkIdQuestion($transfer->getFkIdQuestion());
        $entity->setLanguage($transfer->getLanguage());
        $entity->delete();
        return new FaqTranslationTransfer();
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteVoteEntityByPrimaryKey(FaqVotesTransfer $transfer): FaqVotesTransfer {
        $entity = new PyzFaqVotes();
        $entity->setFkIdQuestion($transfer->getFkIdQuestion());
        $entity->setFkIdCustomer($transfer->getFkIdCustomer());
        $entity->delete();
        return new FaqVotesTransfer();
    }



}
