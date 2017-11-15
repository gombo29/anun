<?php

namespace anun\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class anunSecurityBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
