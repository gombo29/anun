<?php

namespace anun\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('@anunWeb/Default/index.html.twig', array('menu' => 1));
    }

    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function aboutusAction()
    {
        return $this->render('@anunWeb/Default/aboutus.html.twig', array('menu' => 2));
    }

    /**
     * @Route("/products", name="products")
     */
    public function productsAction()
    {
        return $this->render('@anunWeb/Default/products.html.twig', array('menu' => 3));
    }

    /**
     * @Route("/service", name="service")
     */
    public function serviceAction()
    {
        return $this->render('@anunWeb/Default/service.html.twig', array('menu' => 4));
    }

    /**
     * @Route("/contact-us", name="contactus")
     */
    public function contactusAction()
    {
        return $this->render('@anunWeb/Default/contact-us.html.twig', array('menu' => 5));
    }
}
