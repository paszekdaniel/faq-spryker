<?php

namespace Pyz\Zed\Faq\Communication\Form;

use Pyz\Zed\Faq\FaqConfig;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionCollectionForm extends AbstractType
{
    public const FIELD_TRANSLATIONS = 'translations';
    public const FILED_STATE = 'state';
    public const FIELD_DEFAULT_QUESTION = 'question';
    public const FIELD_DEFAULT_ANSWER = 'answer';
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addDefaultQuestionField($builder)
            ->addDefaultAnswerField($builder)
            ->addStateField($builder)
            ->addTranslationsFields($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addTranslationsFields(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_TRANSLATIONS, CollectionType::class, [
            'entry_type' => QuestionTranslationForm::class,
            'entry_options' => [],
        ]);

        return $this;
    }
    protected function addStateField(FormBuilderInterface $builder): self
    {
        $builder->add(self::FILED_STATE, ChoiceType::class, [
            'choices' => [
                'Active' => FaqConfig::ACTIVE_STATE,
                'Inactive' => FaqConfig::INACTIVE_STATE
            ]
        ]);
        return $this;
    }
    protected function addDefaultQuestionField(FormBuilderInterface $builder) {
        $builder->add(self::FIELD_DEFAULT_QUESTION, TextType::class);
        return $this;
    }

    protected function addDefaultAnswerField(FormBuilderInterface $builder) {
        $builder->add(self::FIELD_DEFAULT_ANSWER, TextType::class);
        return $this;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'translation';
    }

}
