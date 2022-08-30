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
    //Same as get /faq I guess
    //I have votes counting implemented there so this should work
    //And I don't think response should look like my pyz_faq_vote table (fk_id_question, fk_id_customer, vote) :)
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface {
        if(!$restRequest->getResource()->getId()) {
            return $this->getFactory()->createFaqReader()->getActiveFaqQuestions($restRequest);
        } else {
            return $this->getFactory()->createFaqReader()->getOneFaqQuestion($restRequest);
        }
//        Data from session, thanks to api there is only idCustomer
//        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
//        dd($customer);
    }
}
