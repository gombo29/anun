<?php

namespace anun\CmsBundle\Controller;

use anun\CmsBundle\Entity\Item;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/hahaha")
     */
    public function indexAction()
    {
        return $this->render('anunCmsBundle:Default:index.html.twig');
    }
}
