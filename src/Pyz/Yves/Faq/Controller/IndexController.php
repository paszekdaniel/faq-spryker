<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqClientInterface getClient()
 */
class IndexController extends AbstractController
{
    public function indexAction(Request $request) {
        $collection = new FaqQuestionCollectionTransfer();
        $collection = $this->getClient()->getActiveFaqQuestionCollection($collection);
        $data = ['questions' => $collection->getQuestions()];
//        foreach ($collection->getQuestions() as $question) {
////            $question->getIdQuestion();
////            $question->getVo
//        }
        return $this->view(
            $data,
            [],
            '@Faq/views/index/index.twig'
        );
    }
    public function voteUpAction(Request $request) {
        dd($request);
    }
}
