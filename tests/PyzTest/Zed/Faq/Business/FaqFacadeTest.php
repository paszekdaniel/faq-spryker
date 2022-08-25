<?php

namespace PyzTest\Zed\Faq\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\FaqQuestionBuilder;
use Generated\Shared\DataBuilder\FaqQuestionCollectionBuilder;
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

    public function testSaveQuestion(): void {
        $transfer = (new FaqQuestionBuilder([
            'question' => 'test',
            'answer' => 'test answer',
            'state' => FaqConfig::INACTIVE_STATE,
            'fk_id_user' => 1
        ]))->build();

        $this->tester->getFacade()->saveQuestion($transfer);
        /**
         * @var FaqQuestionTransfer $result
         */
        $result = $this->tester->getFacade()->findQuestionByID($transfer);

        $this->assertEquals($result->getIdQuestion(), $transfer->getIdQuestion());
        $this->assertEquals($result->getAnswer(), 'test answer');
    }
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
}
