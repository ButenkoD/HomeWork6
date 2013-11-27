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
use Acme\StoreBundle\Entity\Color;


class LoadColorData extends AbstractFixture implements OrderedFixtureInterface
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
        $colorObject1 = new Color();
        $colorObject1->setColor("black");
        $this->setReference('b',$colorObject1);
        $manager->persist($colorObject1);

        $colorObject2 = new Color();
        $colorObject2->setColor("white");
        $this->setReference('w',$colorObject2);
        $manager->persist($colorObject2);

        $colorObject3 = new Color();
        $colorObject3->setColor("red");
        $this->setReference('r',$colorObject3);
        $manager->persist($colorObject3);


        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
} 