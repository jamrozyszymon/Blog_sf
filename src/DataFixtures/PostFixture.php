<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixture extends Fixture implements DependentFixtureInterface
{
    private $dataContent = array(
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.',
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.',
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.'
    );

    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<100; $i++){
            $categoryId = random_int(1,18);
            $category = $manager->getRepository(Category::class)->find($categoryId);
            $userId = random_int(1,25);
            $user = $manager->getRepository(User::class)->find($userId);
            $randomContent = $this->dataContent[array_rand($this->dataContent, 1)];

            $post= new Post();
            $post->setUsers($user);
            $post->setCategories($category);
            $post->setContent($randomContent);
            
            //parent for selected posts
            if($i<70) {
                $post->setParent(null);
                $post->onPrePersistFixture($this->randomTime(new DateTime("2022-05-01"), new DateTime("2022-08-01")));

            } else {
                $postParentId = $manager->getRepository(Post::class)->findAllPostByIdFixture($categoryId);
                $postParent = $manager->getRepository(Post::class)->find($postParentId[0]);

                $post->setParent($postParent);
                $post->onPrePersistFixture($this->randomTime(new DateTime("2022-08-02"), new DateTime("now")));
            }
            

            //positive opinion
            for($userPositiveId=1 ; $userPositiveId <random_int(1,20); $userPositiveId ++) {
                $userPositive = $manager->getRepository(User::class)->find($userPositiveId);
                $post->addUsersPositive($userPositive);
            }

            //negative opinion
            for($h=1; $h<random_int(1,20); $h++) {
                $userNegativeId = random_int(1, 20);
                $userNegative = $manager->getRepository(User::class)->find($userNegativeId);
                $post->addUsersNegative($userNegative);
            }

            $manager->persist($post);
            $manager->flush();
        }

    }

    public function randomTime(DateTime $start, DateTime $end) 
    {
        $random = mt_rand($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new DateTime();
        $randomDate->setTimestamp($random);
        return $randomDate;

    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
            CategoryFixture::class
        ];
    }
}
