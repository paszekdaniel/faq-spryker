<?php

namespace Pyz\Glue\FaqRestApi\Controller;

use Pyz\Glue\FaqRestApi\FaqRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method FaqRestApiFactory getFactory()
 */
class FaqResourceController extends AbstractController
{
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface {
        if(!$restRequest->getResource()->getId()) {
            return $this->getFactory()->createFaqReader()->getFaqQuestions($restRequest);
        } else {
            return $this->getFactory()->createFaqReader()->getOneFaqQuestion($restRequest);
        }
    }
    public function postAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqChanger()->createFaqQuestion($restRequest);
    }
    public function patchAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqChanger()->updateFaqQuestion($restRequest);

    }
    public function deleteAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqChanger()->deleteFaqQuestion($restRequest);

    }

}
