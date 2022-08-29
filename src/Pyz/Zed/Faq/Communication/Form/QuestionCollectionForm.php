<?php

namespace Pyz\Zed\Faq\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionCollectionForm extends AbstractType
{
    public const FIELD_TRANSLATIONS = 'translations';
    public const FILED_STATE = 'state';
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
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
        $builder->add(self::FILED_STATE, TextType::class, [
            'required' => false
        ]);
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
