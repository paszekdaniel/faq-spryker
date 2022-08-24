<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;

interface FaqEntityManagerInterface
{
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveQuestionEntityCascade(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTranslationEntity(FaqTranslationTransfer $transfer): FaqTranslationTransfer;
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveVoteEntity(FaqVotesTransfer $transfer): FaqVotesTransfer;
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteQuestionEntityByPrimaryKey(FaqQuestionTransfer $transfer): FaqQuestionTransfer;
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteTranslationEntityByPrimaryKey(FaqTranslationTransfer $transfer): FaqTranslationTransfer;
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteVoteEntityByPrimaryKey(FaqVotesTransfer $transfer): FaqVotesTransfer;
}
