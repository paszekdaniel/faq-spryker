# Faq module
tables relations: faq diagram.png <br>

## TODO:
[x] define schema and generate diagram <br>
[x] dto <br>

### US1
[x] Use translation table <br>
[ ] Create form with other languages <br>
Checkout product-attribute-gui module for translation <br>
NestedForm => AttributeTranslationCollectionForm -> AttributeTranslationForm -> AttributeValueTranslationForm
Symfony\Component\Form\Extension\Core\Type\CollectionType;
$availableLocales = $this->localeFacade->getLocaleCollection();
class AttributeTranslationFormCollectionDataProvider->getTranslationFields->$fields

## PROBLEMS:
- Glue API is FaqRestApi, instead of FaqsRestApi(S!), so data.type is faq, not faqs
-
