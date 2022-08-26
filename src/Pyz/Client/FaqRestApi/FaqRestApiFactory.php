<?php

namespace Pyz\Client\FaqRestApi;

use Pyz\Client\FaqRestApi\Zed\FaqRestApiZedStub;
use Pyz\Client\FaqRestApi\Zed\FaqRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqRestApiFactory extends AbstractFactory
{
    public function createFaqZedStub(): FaqRestApiZedStubInterface {
        return new FaqRestApiZedStub($this->getZedRequestClient());
    }

    protected function getZedRequestClient(): ZedRequestClientInterface {
        return $this->getProvidedDependency(FaqRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
