<?php

namespace Pyz\Zed\Faq\Communication\Table;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\Map\PyzFaqQuestionTableMap;
use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Propel\Runtime\Collection\ObjectCollection;
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
    public const COL_VOTE_UP = 'voteDown';
    public const COL_VOTE_DOWN = 'voteUp';

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
            PyzFaqQuestionTableMap::COL_ID_QUESTION => "id",
            PyzFaqQuestionTableMap::COL_QUESTION => "question",
            PyzFaqQuestionTableMap::COL_ANSWER => "answer",
            self::COL_VOTE_UP => "votes up",
            self::COL_VOTE_DOWN => "votes down",
            PyzFaqQuestionTableMap::COL_STATE => "state",
            self::COL_ACTIONS => 'Actions'
        ]);

        $config->setSortable([
            PyzFaqQuestionTableMap::COL_QUESTION,
            PyzFaqQuestionTableMap::COL_ANSWER,
//  can't sort by votes, because they aren't calculated by query
//            self::COL_VOTE_UP,
//            self::COL_VOTE_DOWN
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
        $collection->populateRelation('PyzFaqVote');
        $questionRows = [];
//    dd($collection);
        foreach ($collection as $question) {
            /**
             * @var PyzFaqQuestion $question
             */
            $row = [];
            $votesCount = $this->countVotes($question);
            $row[PyzFaqQuestionTableMap::COL_ID_QUESTION] = $question->getIdQuestion();
            $row[PyzFaqQuestionTableMap::COL_QUESTION] = $this->generateTranslatedQuestion($question);
            $row[PyzFaqQuestionTableMap::COL_ANSWER] = $this->generateTranslatedAnswer($question);
            $row[PyzFaqQuestionTableMap::COL_STATE] = $this->mapStateToText($question->getState());
            $row[self::COL_ACTIONS] = $this->generateItemButtons($question->getIdQuestion());
            $row[self::COL_VOTE_UP] = $votesCount["up"];
            $row[self::COL_VOTE_DOWN] = $votesCount["down"];
            $questionRows[] = $row;
        }
        return $questionRows;
    }

    protected function formatText(string $text)
    {
        return substr($text, 0, self::MAX_LENGTH) . '...';
    }

    protected function countVotes(PyzFaqQuestion $question): array
    {
        $up = 0;
        $down = 0;
        foreach ($question->getPyzFaqVotes() as $vote) {
            if ($vote->getVote() === FaqConfig::VOTE_UP) {
                $up++;
            } else {
                $down++;
            }
        }
        return [
            'up' => $up,
            'down' => $down
        ];
    }

//    Can't use FaqBusinessMapper::translate, because it is model, not transfer!
    protected function generateTranslatedQuestion(PyzFaqQuestion $question)
    {
        foreach ($question->getPyzFaqTranslations() as $translation) {
            /**
             * @var PyzFaqTranslation $translation
             */
            if ($translation->getLanguage() === $this->localeFacade->getCurrentLocaleName()) {
                return $this->formatText($translation->getTranslatedQuestion());
            }
        }
        return $this->formatText($question->getQuestion());
    }

    protected function generateTranslatedAnswer(PyzFaqQuestion $question)
    {
        foreach ($question->getPyzFaqTranslations() as $translation) {
            /**
             * @var PyzFaqTranslation $translation
             */

            if ($translation->getLanguage() === $this->localeFacade->getCurrentLocaleName()) {
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
            "/faq/edit?id=" . $id
        );
        $btnGroup[] = $this->createButtonGroupItem(
            "Delete",
            "/faq/delete?id=" . $id
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

    protected function mapStateToText(int $state)
    {
        if ($state == FaqConfig::ACTIVE_STATE) {
            return "active";
        }
        return "inactive";
    }
}
