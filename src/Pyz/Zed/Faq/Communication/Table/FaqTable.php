<?php

namespace Pyz\Zed\Faq\Communication\Table;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\Map\PyzFaqQuestionTableMap;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class FaqTable extends AbstractTable
{
    private FaqEntityManagerInterface $entityManager;
    private FaqRepositoryInterface $repository;
    private PyzFaqQuestionQuery $query;
    public const COL_ACTIONS = 'actions';

    public function __construct(FaqEntityManagerInterface $entityManager, FaqRepositoryInterface $repository, PyzFaqQuestionQuery $query)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->query = $query;
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            PyzFaqQuestionTableMap::COL_QUESTION => "question",
            PyzFaqQuestionTableMap::COL_ANSWER => "answer",
            PyzFaqQuestionTableMap::COL_STATE => "state",
            self::COL_ACTIONS => 'Actions'
        ]);

        $config->setSortable([
            PyzFaqQuestionTableMap::COL_QUESTION,
            PyzFaqQuestionTableMap::COL_ANSWER
        ]);
        $config->setSearchable([
            PyzFaqQuestionTableMap::COL_ANSWER,
            PyzFaqQuestionTableMap::COL_QUESTION,
            PyzFaqQuestionTableMap::COL_STATE
        ]);
        $config->setRawColumns([
            self::COL_ACTIONS
        ]);
        return $config;
    }

    protected function prepareData(TableConfiguration $config)
    {
        $collection = new FaqQuestionCollectionTransfer();
        $collection = $this->repository->findActiveQuestionsWithRelations($collection);
        $questionRows = [];
        foreach ($collection->getQuestions() as $question) {
            $row = [];
            $row[PyzFaqQuestionTableMap::COL_QUESTION] = $question->getQuestion();
            $row[PyzFaqQuestionTableMap::COL_ANSWER] = $question->getAnswer();
            $row[PyzFaqQuestionTableMap::COL_STATE] = $question->getState();
            $row[self::COL_ACTIONS] = $this->generateItemButtons($question);

            $questionRows[]= $row;
        }
        return $questionRows;
    }
    protected function generateItemButtons(FaqQuestionTransfer $question) {
        $btnGroup = [];
        $btnGroup[] = $this->createButtonGroupItem(
            "Edit",
            "/planet/edit?id={$question->getIdQuestion()}"
        );
        $btnGroup[] = $this->createButtonGroupItem(
            "Delete",
            "/planet/delete?id={$question->getIdQuestion()}"
        );
        return $this->generateButtonGroup(
            $btnGroup,
            'Actions'
        );
    }
}
