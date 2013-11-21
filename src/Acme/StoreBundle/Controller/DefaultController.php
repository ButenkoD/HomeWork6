<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Category;

class DefaultController extends Controller
{
    public function homeAction()
    {
        $taskArray = array(
            'Research about DB',
            'Use Doctrine',
            'Use Fixtures'
        );

        return $this->render('AcmeStoreBundle:Default:home.html.twig', array('tasklist' => $taskArray));
    }

    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName("Guitar4");
        $product->setPrice(888);
        $product->setDescription("To play black metal for the Satan's glory");

        $category = $em
            ->getRepository("AcmeStoreBundle:Category")
            ->findOneBy(array('id'=>2));

        $product->setCategory($category);

        $em->persist($product);
        $em->persist($category);
        $em->flush();

        return new Response('item #'.$product->getId()." was added to ".$category->getId().'th category' );
        #$this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }

    public function showAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AcmeStoreBundle:Product");

        $product = $repository
            ->findOneBy(array('id'=>$id));

        if(!$product) {
            throw $this->createNotFoundException(
                "Couldn't find item"
            );
        }

        return $this->render('AcmeStoreBundle:Default:show.html.twig', array(
            'product' => $product,
            'category' => $product->getCategory()
        ));
    }

    public function showDescriptionAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AcmeStoreBundle:Product");

        $product = $repository
            ->findOneBy(array('id'=>$id));

        return $this->render('AcmeStoreBundle:Default:showDescription.html.twig', array('product' => $product));
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository("AcmeStoreBundle:Product")
            ->find($id);
        $product->setName("Booze");
        $em->flush();

        #return new Response('updated');
        return $this->redirect($this->generateURL("_show_route", array("id" => $id)));
    }

    public function removeAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository("AcmeStoreBundle:Product")
            ->find($id);
        $em->remove($product);
        $em->flush();

        return new Response('Deleted');
    }
}
