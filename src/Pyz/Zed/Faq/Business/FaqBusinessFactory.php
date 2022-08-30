<?php

namespace Pyz\Zed\Faq\Business;

use Pyz\Zed\Faq\Business\Model\FaqDeleterHandler;
use Pyz\Zed\Faq\Business\Model\FaqReaderHandler;
use Pyz\Zed\Faq\Business\Model\FaqWriterHandler;
use Pyz\Zed\Faq\FaqDependencyProvider;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method FaqRepositoryInterface getRepository()
 * @method FaqEntityManagerInterface getEntityManager()
 */
class FaqBusinessFactory extends AbstractBusinessFactory
{
    public function getFaqWriterHandler(): FaqWriterHandler {
        return new FaqWriterHandler($this->getEntityManager());
    }
    public function getFaqReaderHandler(): FaqReaderHandler {
        return new FaqReaderHandler($this->getRepository(), $this->getProvidedDependency(FaqDependencyProvider::LOCALE_FACADE_BUSINESS));
    }
    public function getFaqDeleterHandler(): FaqDeleterHandler {
        return new FaqDeleterHandler($this->getEntityManager());
    }
//    public function getCustomerFacade(): CustomerFacadeInterface {
//        return $this->getProvidedDependency(FaqDependencyProvider::CUSTOMER_FACADE);
//    }
}
