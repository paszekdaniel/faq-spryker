<?php

namespace Pyz\Zed\Faq\Communication\Form;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\FaqConfig;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FaqQuestionForm extends AbstractType
{

    public const FIELD_QUESTION = 'question';
    public const FIELD_ANSWER = 'answer';
    public const FIELD_STATE = 'state';
    private const BUTTON_SUBMIT = 'Submit';

    public function getBlockPrefix(): string
    {
        return 'question';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => FaqQuestionTransfer::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addQuestionField($builder)->addAnswerField($builder)->addStateField($builder)->addSubmitButton($builder);
    }

    private function addQuestionField(FormBuilderInterface $builder): FaqQuestionForm
    {
        $builder->add(static::FIELD_QUESTION, TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Length([
                    'max' => 255,
                ])
            ]
        ]);
        return $this;
    }
    private function addAnswerField(FormBuilderInterface $builder): FaqQuestionForm
    {
        $builder->add(static::FIELD_ANSWER, TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Length([
                    'max' => 65536,
                ])
            ]
        ]);
        return $this;
    }
    private function addStateField(FormBuilderInterface $builder): FaqQuestionForm
    {
        $builder->add(static::FIELD_STATE, ChoiceType::class, [
            'choices' => [
                'Active' => FaqConfig::ACTIVE_STATE,
                'Inactive' => FaqConfig::INACTIVE_STATE
            ]
        ]);
        return $this;
    }
    private function addSubmitButton(FormBuilderInterface $builder): FaqQuestionForm
    {
        $builder->add(static::BUTTON_SUBMIT, SubmitType::class);
        return $this;
    }
}
