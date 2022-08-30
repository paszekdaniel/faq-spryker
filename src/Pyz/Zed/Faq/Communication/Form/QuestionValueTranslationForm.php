<?php

namespace Pyz\Zed\Faq\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionValueTranslationForm extends AbstractType
{
    public const FILED_ID_QUESTION = 'id_question';
    public const FIELD_VALUE = 'value';
    public const FIELD_TRANSLATION = 'translation';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addIdField($builder)
            ->addValueField($builder)
            ->addTranslationField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addIdField(FormBuilderInterface $builder)
    {
        $builder->add(self::FILED_ID_QUESTION, HiddenType::class);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addValueField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_VALUE, TextType::class, [
            'label' => 'Value',
            'disabled' => true,
            'attr' => [
                'readonly' => true,
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addTranslationField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_TRANSLATION, TextType::class, [
            'label' => 'Translation',
        ]);

        return $this;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'value_translation';
    }
}
