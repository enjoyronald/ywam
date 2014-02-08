<?php

namespace Ywam\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Ywam\MainBundle\Entity\Article;


class PublicController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction()
    {


        // Recuperation d'carr
        $em = $this->getDoctrine()->getManager();
        $articles=$em->getRepository('YwamMainBundle:Article')->findAll();
        return $this->render('YwamMainBundle:Public:index.html.twig', array(
            'articles' => $articles,
        ));
    }
    
    public function afficherAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article=$em->getRepository('YwamMainBundle:Article')->find($id);
        
        return $this->render('YwamMainBundle:Public:articleView.html.twig', array(
            'article' => $article,
        ));
    }
}
