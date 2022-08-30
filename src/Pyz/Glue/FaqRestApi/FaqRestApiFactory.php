<?php

namespace Pyz\Glue\FaqRestApi;

use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqChanger;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqChangerInterface;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqReader;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqReaderInterface;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqVotesChanger;
use Pyz\Glue\FaqRestApi\Processor\Faqs\FaqVotesChangerInterface;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapper;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapperInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method FaqRestApiClientInterface getClient()
 */
class FaqRestApiFactory extends AbstractFactory
{
    public function createFaqResourceMapper(): FaqResourceMapperInterface {
        return new FaqResourceMapper();
    }

    public function createFaqReader(): FaqReaderInterface {
        return new FaqReader(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createFaqResourceMapper()
        );
    }
    public function createFaqChanger(): FaqChangerInterface {
        return new FaqChanger(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createFaqResourceMapper()
        );
    }
    public function createFaqVotesChanger(): FaqVotesChangerInterface {
        return new FaqVotesChanger(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createFaqResourceMapper(),
            $this->getCustomerClient()
        );
    }
    public function getCustomerClient(): CustomerClientInterface {
        return $this->getProvidedDependency(FaqRestApiDependencyProvider::CUSTOMER_CLIENT);
    }
}
