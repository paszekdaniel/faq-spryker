<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method FaqCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction(): array
    {
        $table = $this->getFactory()->createFaqTable();
        return $this->viewResponse([
            'questionTable' => $table->render()
        ]);
    }

    public function tableAction(): JsonResponse {
        $table = $this->getFactory()->createFaqTable();

        return $this->jsonResponse($table->fetchData());
    }
}
