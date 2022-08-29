<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Pyz\Yves\Faq\FaqFactory;
use Pyz\Zed\Faq\FaqConfig;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqClientInterface getClient()
 * @method FaqFactory getFactory()
 */
class VotesController extends AbstractController
{
    public function voteUpAction(Request $request) {
        $voteTransfer = $this->setUpVoteTransfer($request);
        $voteTransfer->setVote(FaqConfig::VOTE_UP);
        $this->getClient()->postVote($voteTransfer);
        $this->addSuccessMessage("Vote saved successfully");
        $this->redirectResponseExternal('http://yves.de.spryker.local/faq/');
    }
    public function voteDownAction(Request $request) {
        $voteTransfer = $this->setUpVoteTransfer($request);
        $voteTransfer->setVote(FaqConfig::VOTE_DOWN);
        $this->getClient()->postVote($voteTransfer);
        $this->addSuccessMessage("Vote saved successfully");
        $this->redirectResponseExternal('http://yves.de.spryker.local/faq/');

    }

    protected function setUpVoteTransfer(Request $request) {
        $voteTransfer = new FaqVoteTransfer();
//        No $this->castId()???
        $id = intval($request->query->get("id"));
        $voteTransfer->setFkIdQuestion($id);
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
        if(!$customer) {
            dd("You need to be logged in to vote");
        }
        $voteTransfer->setFkIdCustomer($customer->getIdCustomer());
        return $voteTransfer;
    }
}
