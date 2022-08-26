<?php

namespace Pyz\Zed\Faq\Communication\Table;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\Map\PyzFaqQuestionTableMap;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Pyz\Zed\Faq\FaqConfig;
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

    private const MAX_LENGTH = 25;

    public function __construct(
        FaqEntityManagerInterface $entityManager,
        FaqRepositoryInterface $repository,
        PyzFaqQuestionQuery $query
    ) {
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
//        $collection = new FaqQuestionCollectionTransfer();
//        $collection = $this->repository->findActiveQuestionsWithRelations($collection);
//        $this->query
        $collection = $this->runQuery(
            $this->query,
            $config
        );
        $questionRows = [];
        foreach ($collection as $question) {
            $row = [];
//            $row[PyzFaqQuestionTableMap::COL_QUESTION] = $question->getQuestion();
//            $row[PyzFaqQuestionTableMap::COL_ANSWER] = $question->getAnswer();
//            $row[PyzFaqQuestionTableMap::COL_STATE] = $question->getState();
            $row[PyzFaqQuestionTableMap::COL_ANSWER] =  substr($question[PyzFaqQuestionTableMap::COL_ANSWER],0, self::MAX_LENGTH) . '...';
            $row[PyzFaqQuestionTableMap::COL_QUESTION] =  substr($question[PyzFaqQuestionTableMap::COL_QUESTION],0, self::MAX_LENGTH) . '...';
            $row[PyzFaqQuestionTableMap::COL_STATE] = $this->mapStateToText($question[PyzFaqQuestionTableMap::COL_STATE]);
//            $row[PyzFaqQuestionTableMap::COL_STATE] = ($question[PyzFaqQuestionTableMap::COL_STATE]);
            $row[self::COL_ACTIONS] = $this->generateItemButtons($question);

            $questionRows[] = $row;
        }
        return $questionRows;
    }

    protected function generateItemButtons($question)
    {
        $btnGroup = [];
        $btnGroup[] = $this->createButtonGroupItem(
            "Edit",
            "/faq/edit?id=". $question[PyzFaqQuestionTableMap::COL_ID_QUESTION]
        );
        $btnGroup[] = $this->createButtonGroupItem(
            "Delete",
            "/faq/delete?id=". $question[PyzFaqQuestionTableMap::COL_ID_QUESTION]
        );
//        $btnGroup[] = $this->createButtonGroupItem(
//            "Delete",
//            "/faq/toggle-state?id=". $question[PyzFaqQuestionTableMap::COL_ID_QUESTION]
//        );
        return $this->generateButtonGroup(
            $btnGroup,
            'Actions'
        );
    }
    protected function mapStateToText(int $state) {
        if($state == FaqConfig::ACTIVE_STATE) {
            return "active";
        }
        return "inactive";
    }
}
