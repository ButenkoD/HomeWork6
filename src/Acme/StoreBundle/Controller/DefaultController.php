<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Category;

class DefaultController extends Controller
{
    public function tasksAction()
    {
        $taskArray = array(
            'Research about DB',
            'Use Doctrine',
            'Use Fixtures'
        );

        return $this->render('AcmeStoreBundle:Default:tasks.html.twig', array('tasklist' => $taskArray));
    }

    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName("Ibanez")
            ->setPrice(888)
            ->setDescription("To play metal (nu-metal)");

        $category = $em
            ->getRepository("AcmeStoreBundle:Category")
            ->findOneBy(array('id'=>1));
        $color = $em
            ->getRepository("AcmeStoreBundle:Color")
            ->findOneBy(array('id'=>3));

        $product->setCategory($category)
             ->addColor($color);

        $em->persist($product);
        $em->flush();

        return $this->redirect($this->generateURL('_show_route', array('id' => $product->getId())));
        #return $this->showAction($product->getId());
    }

    public function showAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AcmeStoreBundle:Product");

        if(isset($id)){
            $product[] = $repository
                ->findOneBy(array('id'=>$id));
        }
        else {
            $product = $repository
                ->findAll();
        }

        return $this->render('AcmeStoreBundle:Default:show.html.twig', array('products' => $product));
    }

    public function showDescriptionAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AcmeStoreBundle:Product");

        if(isset($id)) {
            $product[] = $repository
                ->findOneBy(array('id'=>$id));
        }
        else {
            $product = $repository
                ->findAll();
        }

        return $this->render('AcmeStoreBundle:Default:showDescription.html.twig', array('products' => $product));
    }

    public function showColorAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AcmeStoreBundle:Product");

        if(isset($id)) {
            $product[] = $repository
                ->findOneBy(array('id'=>$id));
        }
        else {
            $product = $repository
                ->findAll();
        }

        return $this->render('AcmeStoreBundle:Default:showColor.html.twig', array('products' => $product));
    }

    public function updateAction($id)
    {
        if(!isset($id)){
            throw $this->createNotFoundException(
                'You must set "id" in URL'
            );
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository("AcmeStoreBundle:Product")
                ->find($id);
            $product->setName("Booze");
            $em->flush();

            return $this->redirect($this->generateURL("_show_route", array("id" => $id)));
        }
    }

    public function removeAction($id)
    {
        if(!isset($id)){
            throw $this->createNotFoundException(
                'You must set "id" in URL'
            );
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository("AcmeStoreBundle:Product")
                ->find($id);
            $em->remove($product);
            $em->flush();

            return $this->redirect($this->generateURL('_show_route'));
        }
    }
}
