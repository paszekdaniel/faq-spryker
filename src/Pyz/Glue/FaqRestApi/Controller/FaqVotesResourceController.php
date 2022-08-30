<?php

namespace Pyz\Glue\FaqRestApi\Controller;


use Pyz\Glue\FaqRestApi\FaqRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method FaqRestApiFactory getFactory()
 */
class FaqVotesResourceController extends AbstractController
{
    //And I don't think response should look like my pyz_faq_vote table (fk_id_question, fk_id_customer, vote) :)
//    But I have counting votes implemented in FaqResourceController, and I'm not sure how to have to 2 responseTransfers
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface {
//        if(!$restRequest->getResource()->getId()) {
//            return $this->getFactory()->createFaqReader()->getActiveFaqQuestions($restRequest);
//        } else {
//            return $this->getFactory()->createFaqReader()->getOneFaqQuestion($restRequest);
//        }
    }
    public function postAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqVotesChanger()->createFaqVote($restRequest);
    }
    public function patchAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqVotesChanger()->updateFaqVote($restRequest);
    }
    public function deleteAction(RestRequestInterface $restRequest): RestResponseInterface {
        return $this->getFactory()->createFaqVotesChanger()->deleteFaqVote($restRequest);
    }
}
