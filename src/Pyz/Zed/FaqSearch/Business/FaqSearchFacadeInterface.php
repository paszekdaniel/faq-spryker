<?php

namespace Pyz\Zed\FaqSearch\Business;

interface FaqSearchFacadeInterface
{
    public function publish(int $idQuestion): void;
}
