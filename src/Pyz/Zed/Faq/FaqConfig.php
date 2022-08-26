<?php

namespace Pyz\Zed\Faq;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class FaqConfig extends AbstractBundleConfig
{
    public const ACTIVE_STATE = 1;
    public const INACTIVE_STATE = 2;

    public const VOTE_UP = 1;
    public const VOTE_DOWN = 2;

}
