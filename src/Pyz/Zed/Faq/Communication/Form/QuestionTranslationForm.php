<?php

namespace Pyz\Zed\Faq\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Spryker\Zed\ProductAttributeGui\Communication\Form\AttributeValueTranslationForm;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionTranslationForm extends AbstractType
{
    public const FIELD_VALUE_TRANSLATIONS = 'value_translations';


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addTranslationFields($builder);
    }





    protected function addTranslationFields(FormBuilderInterface $builder): self
    {
        $builder->add(self::FIELD_VALUE_TRANSLATIONS, CollectionType::class, [
            'label' => "=====================================================",
            'entry_type' => QuestionValueTranslationForm::class,
            'entry_options' => [],
        ]);
        return $this;
    }


    public function getBlockPrefix()
    {
        return 'translation1';
    }
}
