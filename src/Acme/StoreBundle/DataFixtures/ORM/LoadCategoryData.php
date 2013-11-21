<?php
/**
 * Created by PhpStorm.
 * User: kanni
 * Date: 11/20/13
 * Time: 10:21 PM
 */

namespace Acme\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Acme\StoreBundle\Entity\Category;


class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        /**foreach($this->getCategoryArray() as $categoryName){
            $categoryObject = new Category();
            $categoryObject->setName($categoryName);
            #$this->setReference($categoryObject->getId(), $categoryObject);
            $manager->persist($categoryObject);
        }*/
        $categoryObject1 = new Category();
        $categoryObject1->setName("Guitar");
        $this->setReference('1',$categoryObject1);
        $manager->persist($categoryObject1);

        $categoryObject2 = new Category();
        $categoryObject2->setName("Drums");
        $this->setReference('2',$categoryObject2);
        $manager->persist($categoryObject2);

        $categoryObject3 = new Category();
        $categoryObject3->setName("Keyboard");
        $this->setReference('3',$categoryObject3);
        $manager->persist($categoryObject3);


        $manager->flush();
    }

    /**public function getCategoryArray()
    {
        return array(
            'Guitar',
            'Drums',
            'Keyboard'
        );
    }*/

    public function getOrder()
    {
        return 1;
    }
} 