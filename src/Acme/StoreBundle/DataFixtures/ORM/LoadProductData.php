<?php
/**
 * Created by PhpStorm.
 * User: kanni
 * Date: 11/20/13
 * Time: 10:21 PM
 */

namespace Acme\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\Yaml\Yaml;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $productArray = Yaml::parse($this->getProductFile());

        foreach($productArray['products'] as $productItem){
            $productObject = new Product();

            $productObject
                ->setName($productItem['name'])
                ->setPrice($productItem['price'])
                ->setDescription($productItem['description'])
                ->setCategory($this->getReference((int)$productItem['category']));

            $manager->persist($productObject);
        }
        $manager->flush();
    }

    public function getProductFile()
    {
        return __DIR__.'/../data/product.yml';
    }

    public function getOrder()
    {
        return 2;
    }
} 