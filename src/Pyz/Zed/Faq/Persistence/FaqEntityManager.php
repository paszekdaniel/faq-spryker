<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Orm\Zed\Faq\Persistence\PyzFaqVote;
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
    public function saveVoteEntity(FaqVoteTransfer $transfer): FaqVoteTransfer {
        $query = $this->getFactory()->createFaqVotesQuery();
        $saver = $this->getFactory()->createFaqSaver();
        return $saver->saveVoteEntity($transfer, $query);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteQuestionEntityByPrimaryKey(FaqQuestionTransfer $transfer): FaqQuestionTransfer {
        $entity = new PyzFaqQuestion();
        $id = $transfer->getIdQuestion();
        $entity->setIdQuestion($id)->delete();
        //return empty???
        $transfer = new FaqQuestionTransfer();
        $transfer->setIdQuestion($id);
        return $transfer;
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
    public function deleteVoteEntityByPrimaryKey(FaqVoteTransfer $transfer): FaqVoteTransfer {
        $entity = new PyzFaqVote();
        $entity->setFkIdQuestion($transfer->getFkIdQuestion());
        $entity->setFkIdCustomer($transfer->getFkIdCustomer());
        $entity->delete();
        return new FaqVoteTransfer();
    }



}
