<?php

namespace Ywam\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Ywam\MainBundle\Entity\Article;
use Ywam\MainBundle\Form\ArticleType;

class AdminController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles=$em->getRepository('YwamMainBundle:Article')->findAll();
        return $this->render('YwamMainBundle:Admin:index.html.twig', array(
            'articles' => $articles,
        ));
       // return new Response('Index Admin controller test');
    }
    
    public function ajouterAction()
    {
         $em = $this->getDoctrine()->getManager();
         $article = new Article();
         $form = $this->createForm(new ArticleType(), $article);
         
         $request = $this->get('request');
         if($request->getMethod() == 'POST') {
             $form->bind($request);
             
             if($form->isValid()){
                 
                 $em->persist($article);
                 $em->flush();
                 
                 return $this->redirect($this->generateUrl('_ywam_admin_index'));
             }
         }
        return $this->render('YwamMainBundle:Admin:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function modifierAction()
    {
        return new Response('modifier Admin controller test');
    }
    public function supprimerAction()
    {
        return new Response('Supprimer Admin controller test');
    }
    
}
