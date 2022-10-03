<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixture extends Fixture
{
    private $dataDesc = array(
        'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'It is a long established fact that a reader will be distracted by the readable content of a page'
    );

    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<20; $i++) {
        $category = new Category();
        $category->setName('Kategoria '.$i);

        $randomDesc = $this->dataDesc[array_rand($this->dataDesc, 1)];
        $category->setDescription($randomDesc);

        $manager->persist($category);
        $manager->flush();
        }
    }

}
