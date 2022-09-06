<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqClientInterface getClient()
 */
class ShowController extends AbstractController
{
    public function indexAction(string $id) {
        $data = ['question' => $this->getClient()->getFaqQuestionFromSearchById('1')];
        return $this->view(
            $data,
            [],
            '@Faq/views/show/index.twig'
        );
    }
    public function voteUpAction(Request $request) {
        dd($request);
    }
}
