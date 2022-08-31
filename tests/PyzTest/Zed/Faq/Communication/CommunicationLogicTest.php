<?php

namespace PyzTest\Zed\Faq\Communication;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\FaqQuestionBuilder;
use Generated\Shared\DataBuilder\FaqTranslationBuilder;
use Generated\Shared\DataBuilder\FaqVoteBuilder;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\FaqCommunicationMapper;
use Pyz\Zed\Faq\Communication\Form\QuestionCollectionForm;
use Pyz\Zed\Faq\Communication\Form\QuestionTranslationForm;
use Pyz\Zed\Faq\Communication\Form\QuestionValueTranslationForm;
use Pyz\Zed\Faq\Communication\QuestionTranslationDataProvider;
use Pyz\Zed\Faq\FaqConfig;
use PyzTest\Zed\Faq\FaqCommunicationTester;

class CommunicationLogicTest extends Unit
{
    /**
     * @var FaqCommunicationTester
     */
    protected $tester;

    public function testDataProvider(): void
    {
        $localeFacade = $this->tester->getLocator()->locale()->facade();
        /**
         * @var FaqFacadeInterface $faqFacade
         */
        $faqFacade = $this->tester->getFacade();
        $dataProvider = new QuestionTranslationDataProvider(
            $faqFacade,
            $localeFacade
        );
        $transfer = $this->createQuestionWithRelationsAndFindItById();
        $data = $dataProvider->getData($transfer->getIdQuestion());
        $this->assertIsInt($data[QuestionCollectionForm::FILED_STATE]);
        $this->assertEquals($data[QuestionCollectionForm::FIELD_DEFAULT_ANSWER], $transfer->getDefaultAnswer());
        $this->assertEquals($data[QuestionCollectionForm::FIELD_DEFAULT_QUESTION], $transfer->getDefaultQuestion());

        foreach ($data[QuestionCollectionForm::FIELD_TRANSLATIONS] as $key => $translation) {
            $keys = array_keys($localeFacade->getLocaleCollection());
            $this->assertTrue(in_array($key, $keys));
            foreach($translation[QuestionTranslationForm::FIELD_VALUE_TRANSLATIONS] as $field => $arr) {
                if($field === "question") {
                    $this->assertEquals($arr[QuestionValueTranslationForm::FIELD_VALUE], $transfer->getDefaultQuestion());
                }
                if($field === "answer") {
                    $this->assertEquals($arr[QuestionValueTranslationForm::FIELD_VALUE], $transfer->getDefaultAnswer());
                }
            }
        }
    }
    public function testCommunicationMapper(): void {
        $input = [
            "translations" => [
                "en_US" => [
                    "value_translations" => [
                        "question" => [
                            "id_question" => null,
                            "value" => "defaultQuestion",
                            "translation" => "en question"
                        ],
                        "answer" => [
                            "id_question" => null,
                            "value" => "defaultAnswer",
                            "translation" => "en answer"
                        ],
                    ]
                ],
                "de_DE" => [
                    "value_translations" => [
                        "question" => [
                            "id_question" => null,
                            "value" => "defaultQuestion",
                            "translation" => "de question"
                        ],
                        "answer" => [
                            "id_question" => null,
                            "value" => "defaultAnswer",
                            "translation" => "de answer"
                        ],
                    ]
                ]
            ],
            "state" => 1,
            "answer" => "defaultAnswer",
            "question" => "defaultQuestion",
            "id_question" => null,
        ];
        $transfer = FaqCommunicationMapper::mapTranslationFormToQuestionTransfer($input);
        $this->assertEquals($transfer->getAnswer(), "defaultAnswer");
        $this->assertEquals($transfer->getQuestion(), "defaultQuestion");
        foreach ($transfer->getTranslations() as $translation) {
           $this->assertTrue($translation->getTranslatedQuestion() === "en question" || $translation->getTranslatedQuestion() === "de question");
           $this->assertTrue($translation->getTranslatedAnswer() === "en answer" || $translation->getTranslatedAnswer() === "de answer");
        }
    }

    protected function createQuestionWithRelationsAndFindItById(): FaqQuestionTransfer
    {
        $transfer = (new FaqQuestionBuilder([
            'question' => 'test',
            'answer' => 'test answer',
            'state' => FaqConfig::INACTIVE_STATE,
            'fk_id_user' => 1
        ]))->build();
        $transfer->addTranslation(
            (new FaqTranslationBuilder([
                'language' => 'en_US',
                'translated_question' => 'en translation',
                'translated_answer' => 'en answer translation'
            ]))->build()
        );
        $transfer->addTranslation(
            (new FaqTranslationBuilder([
                'language' => 'de_DE',
                'translated_question' => 'de translation',
                'translated_answer' => 'de answer translation'
            ]))->build()
        );
        $transfer->addVote(
            (new FaqVoteBuilder([
                'fk_id_customer' => 1,
                'vote' => FaqConfig::VOTE_UP
            ]))->build()
        );
        $transfer->addVote(
            (new FaqVoteBuilder([
                'fk_id_customer' => 2,
                'vote' => FaqConfig::VOTE_UP
            ]))->build()
        );
        $this->tester->getFacade()->saveQuestion($transfer);
        /**
         * @var FaqQuestionTransfer $result
         */
        $result = $this->tester->getFacade()->findQuestionByID($transfer);
        return $result;
    }
}
