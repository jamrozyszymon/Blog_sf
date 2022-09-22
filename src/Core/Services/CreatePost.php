<?php

namespace App\Core\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;

class CreatePost
{
    public function __construct(private EntityManagerInterface $entityManagerInterface)
    {}

    public function create(string $content, $postAnswers, $user, $category): Post
    {
        $post = new Post();
        $post->setContent($content);
        $post->setParent($postAnswers);
        $post->setUsers($user);
        $post->setCategories($category);
        $this->entityManagerInterface->persist($post);
        $this->entityManagerInterface->flush();
        return $post;
    }

}
