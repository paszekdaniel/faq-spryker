<?php

namespace Pyz\Zed\Faq\Communication\Table;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\Map\PyzFaqQuestionTableMap;
use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Pyz\Zed\Faq\FaqConfig;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class FaqTable extends AbstractTable
{
//    private FaqEntityManagerInterface $entityManager;
//    private FaqRepositoryInterface $repository;
    private PyzFaqQuestionQuery $query;
    public const COL_ACTIONS = 'actions';

    private const MAX_LENGTH = 25;
    private LocaleFacadeInterface $localeFacade;

    public function __construct(
//        FaqEntityManagerInterface $entityManager,
//        FaqRepositoryInterface $repository,
        PyzFaqQuestionQuery $query,
        LocaleFacadeInterface $localeFacade
    ) {
//        $this->entityManager = $entityManager;
//        $this->repository = $repository;
        $this->query = $query;

        $this->localeFacade = $localeFacade;
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
        $language = $this->localeFacade->getCurrentLocaleName();

//        Can't use with() and limit() together!
//        $questionQuery = $this->query
//            ->leftJoinPyzFaqTranslation()
//            ->addJoinCondition('PyzFaqTranslation', 'pyz_faq_translation.language = ?', "DE");

        $collection = $this->runQuery(
            $this->query,
            $config,
            true
        );

        $collection->populateRelation('PyzFaqTranslation');
        $questionRows = [];
//    dd($collection);
        foreach ($collection as $question) {
            /**
             * @var PyzFaqQuestion $question
             */
            $row = [];
            $row[PyzFaqQuestionTableMap::COL_QUESTION] = $this->generateTranslatedQuestion($question);
            $row[PyzFaqQuestionTableMap::COL_ANSWER] = $this->generateTranslatedAnswer($question);
            $row[PyzFaqQuestionTableMap::COL_STATE] = $this->mapStateToText($question->getState());
            $row[self::COL_ACTIONS] = $this->generateItemButtons($question->getIdQuestion());
            $questionRows[] = $row;
        }
        return $questionRows;
    }

    protected function formatText(string $text) {
        return substr($text, 0, self::MAX_LENGTH) . '...';
    }

    protected function generateTranslatedQuestion(PyzFaqQuestion $question) {
        foreach ($question->getPyzFaqTranslations() as $translation) {
            /**
             * @var PyzFaqTranslation $translation
             */
            if($translation->getLanguage() === $this->localeFacade->getCurrentLocaleName()) {
                return $this->formatText($translation->getTranslatedQuestion());
            }
        }
        return $this->formatText($question->getQuestion());
    }
    protected function generateTranslatedAnswer(PyzFaqQuestion $question) {
        foreach ($question->getPyzFaqTranslations() as $translation) {
            /**
             * @var PyzFaqTranslation $translation
             */

            if($translation->getLanguage() === $this->localeFacade->getCurrentLocaleName()) {
                return $this->formatText($translation->getTranslatedAnswer());
            }
        }
        return $this->formatText($question->getAnswer());
    }

    protected function generateItemButtons($id)
    {
        $btnGroup = [];
        $btnGroup[] = $this->createButtonGroupItem(
            "Edit",
            "/faq/edit?id=". $id
        );
        $btnGroup[] = $this->createButtonGroupItem(
            "Delete",
            "/faq/delete?id=".$id
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
