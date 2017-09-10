<?php

namespace anun\WebBundle\Controller;

use anun\CmsBundle\Entity\ItemCategory;
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
     * @Route("/alban-tasalgaa/{page}", name="albantasalgaa", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function albanTasalgaaAction($page)
    {

        $pagesize = 20;
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:ItemCategory')->createQueryBuilder('n');

        $countQueryBuilder = clone $qb;
        $count = $countQueryBuilder->select('count(n.id)')->getQuery()->getSingleScalarResult();
        /**@var ItemCategory[] $ger */
        $alba = $qb
            ->where('n.parent = 2')
            ->orderBy('n.id', 'desc')
            ->setFirstResult(($page - 1) * $pagesize)
            ->setMaxResults($pagesize)
            ->getQuery()
            ->getArrayResult();

        return $this->render('@anunWeb/Default/alban-tasalgaa.html.twig', array(

            'menu' => 3,
            'pagecount' => ($count % $pagesize) > 0 ? intval($count / $pagesize) + 1 : intval($count / $pagesize),
            'count' => $count,
            'page' => $page,
            'alba' => $alba,

        ));
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
     * @Route("/ger/{page}", name="ger", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function gerAction($page)
    {

        $pagesize = 20;
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:ItemCategory')->createQueryBuilder('n');

        $countQueryBuilder = clone $qb;
        $count = $countQueryBuilder->select('count(n.id)')->getQuery()->getSingleScalarResult();
        /**@var ItemCategory[] $ger */
        $ger = $qb
            ->where('n.parent = 1')
            ->orderBy('n.id', 'desc')
            ->setFirstResult(($page - 1) * $pagesize)
            ->setMaxResults($pagesize)
            ->getQuery()
            ->getArrayResult();


        return $this->render('@anunWeb/Default/ger.html.twig', array(
            'menu' => 3,
            'pagecount' => ($count % $pagesize) > 0 ? intval($count / $pagesize) + 1 : intval($count / $pagesize),
            'count' => $count,
            'page' => $page,
            'ger' => $ger,
        ));
    }


    /**
     * @Route("/uildver", name="uildver")
     */
    public function uildverAction()
    {
        return $this->render('@anunWeb/Default/uildver.html.twig', array('menu' => 3));
    }

}
