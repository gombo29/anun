<?php

namespace anun\WebBundle\Controller;

use anun\CmsBundle\Entity\ItemCategory;
use anun\CmsBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/home2", name="home2")
     */
    public function index2Action()
    {

        return $this->render('@anunWeb/Default/index2.html.twig', array('menu' => 1));
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
        return $this->render('@anunWeb/Default/service.html.twig', array('menu' => 3));
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
            ->orderBy('n.orderNum', 'ASC')
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
     * @Route("/product/{id}/{page}", name="product", requirements={"id" = "\d+", "page" = "\d+"}, defaults={"page" = 1} )
     * @Method({"GET", "POST"})
     * Зөвлөгөөнүүд
     *
     */
    public function productAction(Request $request, $id, $page)
    {
        $isajax = $request->get('isajax');

        $pagesize = 2;
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:Item')->createQueryBuilder('n');

        $countQueryBuilder = clone $qb;
        $count = $countQueryBuilder->select('count(n.id)')->getQuery()->getSingleScalarResult();
        /**@var ItemCategory[] $ger */
        $alba = $qb
            ->leftJoin('n.category', 'c')
            ->addSelect('c')
            ->leftJoin('c.parent', 'p')
            ->addSelect('p')
            ->where('n.category = :id')
            ->setParameter('id', $id)
            ->orderBy('n.id', 'desc')
            ->setFirstResult(($page - 1) * $pagesize)
            ->setMaxResults($pagesize)
            ->getQuery()
            ->getArrayResult();

        $paren1name = '-';
        $paren2name = '-';

        if ($alba) {
            foreach ($alba as $key => $item) {
                if ($key == 0) {
                    $paren1name = $item['category']['parent']['name'];
                    $paren2name = $item['category']['name'];
                } else {
                    break;
                }
            }
        }

        if ($isajax == true) {
            return new JsonResponse(array('code' => 1, 'response' => $alba, 'page' => $page));

        } else {
            return $this->render('@anunWeb/Default/product.html.twig', array(
                'menu' => 3,
                'id' => $id,
                'pagecount' => ($count % $pagesize) > 0 ? intval($count / $pagesize) + 1 : intval($count / $pagesize),
                'count' => $count,
                'page' => $page,
                'alba' => $alba,
                'paren1name' => $paren1name,
                'paren2name' => $paren2name,
            ));
        }
    }

    /**
     * @Route("/product-detail/{id}", name="product_detail", requirements={"id" = "\d+"} )
     * @Method({"GET", "POST"})
     * Зөвлөгөөнүүд
     *
     */
    public function productDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:Item')->createQueryBuilder('n');

        /**@var ItemCategory[] $ger */
        $alba = $qb
            ->leftJoin('n.category', 'c')
            ->addSelect('c')
            ->leftJoin('c.parent', 'p')
            ->addSelect('p')
            ->leftJoin('n.colors', 'co')
            ->addSelect('co')
            ->leftJoin('n.images', 'i')
            ->addSelect('i')
            ->where('n.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $paren1name = '-';
        $paren1id = 0;
        $paren2name = '-';
        $paren2id = 0;
        $name = '-';

        if ($alba) {
            foreach ($alba as $key => $item) {
                if ($key == 0) {
                    $paren1name = $item['category']['parent']['name'];
                    $paren1id = $item['category']['parent']['id'];
                    $paren2name = $item['category']['name'];
                    $paren2id = $item['category']['id'];
                    $paren2img = $item['category']['imgPath'];
                    $name = $item['name'];
                    $code = $item['serialCode'];
                    $headline = $item['headLine'];
                    $content = $item['content'];
                    $description = $item['description'];
                    $colors = $item['colors'];
                } else {
                    break;
                }
            }
        }

        $qb = $em->getRepository('anunCmsBundle:Item')->createQueryBuilder('n');

        /**@var ItemCategory[] $ger */
        $suggest = $qb
            ->where('n.category = :id')
            ->andWhere('n.id != :thisid')
            ->setParameter('id', $paren2id)
            ->setParameter('thisid', $id)
            ->setMaxResults(3)
            ->getQuery()
            ->getArrayResult();


        return $this->render('@anunWeb/Default/product-detail.html.twig', array('menu' => 3, 'id' => $id, 'alba' => $alba, 'paren1name' => $paren1name,
            'paren2name' => $paren2name, 'paren1id' => $paren1id, 'paren2id' => $paren2id, 'name' => $name,
            'code' => $code,
            'headline' => $headline,
            'content' => $content,
            'description' => $description,
            'colors' => $colors,
            'paren2img' => $paren2img,
            'suggest' => $suggest

        ));
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
     * @Route("/uildver/{page}", name="uildver", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function uildverAction($page)
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


        return $this->render('@anunWeb/Default/uildver.html.twig', array(

            'menu' => 3,
            'pagecount' => ($count % $pagesize) > 0 ? intval($count / $pagesize) + 1 : intval($count / $pagesize),
            'count' => $count,
            'page' => $page,
            'ger' => $ger,

        ));
    }


    /**
     * @Route("/projects", name="projects")
     */
    public function projectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:Project')->createQueryBuilder('n');

        /**@var Project[] $project */
        $project = $qb
            ->getQuery()
            ->getArrayResult();


        return $this->render('@anunWeb/Default/projects.html.twig', array('menu' => 4, 'project' => $project));
    }

    /**
     * @Route("/projects-detail/{id}", name="projectsDeatail", requirements={"id" = "\d+"})
     */
    public function projectsDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('anunCmsBundle:Project')->createQueryBuilder('n');

        /**@var Project[] $project */
        $project = $qb
            ->where('n.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        return $this->render('@anunWeb/Default/project-detail.html.twig', array('menu' => 4, 'project' => $project[0]));
    }

    /**
     * @Route("/clearance", name="clearance")
     */
    public function clearanceAction()
    {
        return $this->render('@anunWeb/Default/clearance.html.twig', array('menu' => 3));
    }

}
