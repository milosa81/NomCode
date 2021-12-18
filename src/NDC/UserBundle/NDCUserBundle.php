<?php

namespace NDC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NDCUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
