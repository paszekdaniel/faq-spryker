<?php

namespace Pyz\Zed\Faq\Communication;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\Form\FaqQuestionForm;
use Pyz\Zed\Faq\Communication\Form\QuestionCollectionForm;
use Pyz\Zed\Faq\Communication\Table\FaqTable;
use Pyz\Zed\Faq\FaqDependencyProvider;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\User\Business\UserFacadeInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @method FaqEntityManagerInterface getEntityManager()
 * @method FaqRepositoryInterface getRepository()
 * @method FaqFacadeInterface getFacade()
 */
class FaqCommunicationFactory extends AbstractCommunicationFactory
{
    public function createFaqTable(): FaqTable {
        return new FaqTable(
//            $this->getEntityManager(),
//            $this->getRepository(),
            $this->getQuestionQuery(),
            $this->getLocaleFacade()
        );
    }

    public function createQuestionTranslationDataProvider() {
        return new QuestionTranslationDataProvider(
            $this->getFacade(),
            $this->getLocaleFacade()
        );
    }

    private function getQuestionQuery(): PyzFaqQuestionQuery {
        return $this->getProvidedDependency(FaqDependencyProvider::QUERY_QUESTION);
    }

    public function createFaqQuestionForm(?FaqQuestionTransfer $transfer = null, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(
            FaqQuestionForm::class,
            $transfer,
            $options
        );
    }
    public function createQuestionTranslationForm(array $data = null, array $options = []): FormInterface {
        return $this->getFormFactory()->create(
            QuestionCollectionForm::class,
            $data,
            $options
        );
    }
    public function getLocaleFacade():  LocaleFacadeInterface {
        return $this->getProvidedDependency(FaqDependencyProvider::LOCALE_FACADE_COMMUNICATION);
    }
    public function getUserFacade(): UserFacadeInterface{
        return $this->getProvidedDependency(FaqDependencyProvider::USER_FACADE);
    }
//    public function getCustomerFacade(): ?CustomerFacadeInterface {
//        return $this->getProvidedDependency(FaqDependencyProvider::CUSTOMER_FACADE);
//    }
}
