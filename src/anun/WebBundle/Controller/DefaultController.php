<?php

namespace anun\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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


    /**
     * @Route("/alban-tasalgaa", name="albantasalgaa")
     */
    public function albanTasalgaaAction()
    {
        return $this->render('@anunWeb/Default/alban-tasalgaa.html.twig', array('menu' => 3));
    }


    /**
     * @Route("/product/{id}", name="product", requirements={"id" = "\d+"} )
     * @Method({"GET", "POST"})
     * Зөвлөгөөнүүд
     *
     */
    public function productAction($id)
    {
        return $this->render('@anunWeb/Default/product.html.twig', array('menu' => 3, 'id' => $id));
    }

    /**
     * @Route("/product-detail/{id}", name="product_detail", requirements={"id" = "\d+"} )
     * @Method({"GET", "POST"})
     * Зөвлөгөөнүүд
     *
     */
    public function productDetailAction($id)
    {
        return $this->render('@anunWeb/Default/product-detail.html.twig', array('menu' => 3, 'id' => $id));
    }

    /**
     * @Route("/ger", name="ger")
     */
    public function gerAction()
    {
        return $this->render('@anunWeb/Default/ger.html.twig', array('menu' => 3));
    }


    /**
     * @Route("/uildver", name="uildver")
     */
    public function uildverAction()
    {
        return $this->render('@anunWeb/Default/uildver.html.twig', array('menu' => 3));
    }

}
