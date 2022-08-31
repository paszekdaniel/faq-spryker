<?php

namespace PyzTest\Zed\Faq\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\FaqQuestionBuilder;
use Generated\Shared\DataBuilder\FaqQuestionCollectionBuilder;
use Generated\Shared\DataBuilder\FaqTranslationBuilder;
use Generated\Shared\DataBuilder\FaqVoteBuilder;
use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\FaqConfig;
use PyzTest\Zed\Faq\FaqBusinessTester;

class FaqFacadeTest extends Unit
{
    /**
     * @var FaqBusinessTester
     */
    protected $tester;

    protected function createQuestionWithRelationsAndFindItById(): FaqQuestionTransfer
    {
        $transfer = (new FaqQuestionBuilder([
            'question' => 'test',
            'answer' => 'test answer',
            'state' => FaqConfig::INACTIVE_STATE,
            'fk_id_user' => 1
        ]))->build();
        $transfer->addTranslation((new FaqTranslationBuilder([
            'language' => 'en_US',
            'translated_question' => 'en translation',
            'translated_answer' => 'en answer translation'
        ]))->build());
        $transfer->addTranslation((new FaqTranslationBuilder([
            'language' => 'de_DE',
            'translated_question' => 'de translation',
            'translated_answer' => 'de answer translation'
        ]))->build());
        $transfer->addVote((new FaqVoteBuilder([
            'fk_id_customer' => 1,
            'vote' => FaqConfig::VOTE_UP
        ]))->build());
        $transfer->addVote((new FaqVoteBuilder([
            'fk_id_customer' => 2,
            'vote' => FaqConfig::VOTE_UP
        ]))->build());
        $this->tester->getFacade()->saveQuestion($transfer);
        /**
         * @var FaqQuestionTransfer $result
         */
        $result = $this->tester->getFacade()->findQuestionByID($transfer);
        return $result;
    }

    public function testSaveQuestionCascade(): void {
        $result = $this->createQuestionWithRelationsAndFindItById();

//        $this->assertEquals($result->getIdQuestion(), $transfer->getIdQuestion());
        $this->assertEquals($result->getDefaultAnswer(), 'test answer');
        $this->assertEquals($result->getTranslations()->count(), 2);
        foreach ($result->getTranslations() as $translation) {
            $this->assertEquals($translation->getFkIdQuestion(), $result->getIdQuestion());
        }
        foreach ($result->getVotes() as $vote) {
            $this->assertEquals($vote->getFkIdQuestion(), $result->getIdQuestion());
        }
    }
//    No need to test cascade, since mysql does it
    public function testDeleteQuestion(): void {
        $transfer = (new FaqQuestionBuilder([
            'question' => 'test',
            'answer' => 'test answer',
            'state' => FaqConfig::INACTIVE_STATE,
            'fk_id_user' => 1
        ]))->build();
        /**
         * @var FaqQuestionTransfer $result
         */
        $result = $this->tester->getFacade()->saveQuestion($transfer);
        $id = $result->getIdQuestion();

        $this->tester->getFacade()->deleteQuestion($result);

        $toFound = (new FaqQuestionBuilder([
            'id_question' => $id
        ]))->build();

        $resultDeleted = $this->tester->getFacade()->findQuestionById($toFound);
        $this->assertNull($resultDeleted->getIdQuestion());
    }

    public function testFindActiveQuestions(): void {
        $transfer = (new FaqQuestionCollectionBuilder())->build();
        /**
         * @var FaqQuestionCollectionTransfer $result
         */
        $result = $this->tester->getFacade()->findActiveQuestions($transfer);
        foreach ($result->getQuestions() as $question) {
            $this->assertEquals($question->getState(), FaqConfig::ACTIVE_STATE);
        }
    }

    public function testAutomaticTranslation(): void {
        $result = $this->createQuestionWithRelationsAndFindItById();

        $this->assertTrue($result->getQuestion() === 'en translation' || $result->getQuestion() === 'de translation' );
        $this->assertTrue($result->getAnswer() === 'en answer translation' || $result->getAnswer() === 'de answer translation' );
    }
    public function testAutomaticVotesCounting(): void {
        $result = $this->createQuestionWithRelationsAndFindItById();

       $this->assertEquals($result->getVotesDown(), 0);
       $this->assertEquals($result->getVotesUp(), 2);
    }

}
