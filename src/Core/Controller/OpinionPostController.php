<?php

namespace App\Core\Controller;

use App\Entity\User;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Manage add/delete positive/negative opinion for post.
 * 1 step - hide all button in 'app.scss' (classes: click-to-...).
 * 2 step - set userNegativeOpinion/UserPositiveOpiinion in 'opinion.html.twig if records exist' (classes: userNegativeOpinion, userPositiveOpinion, noAction).
 * 3 step - manage num of opinion and button in 'opinion.js' (classes: post-id-..., positive-id-..., negative-id-...).
 */
class OpinionPostController extends AbstractController
{
    public function __construct( private ManagerRegistry $doctrine)
    {}

    /**
     * @Route("/Post/{post}/positive", name="positive_post", methods={"POST"})
     * @Route("/Post/{post}/negative", name="negative_post", methods={"POST"})
     * @Route("/Post{post}/backpositive", name="back_positive_post", methods={"POST"})
     * @Route("/Post/{post}/backnegative", name="back_negative_post", methods={"POST"})
     */
    public function toggleOpinion(Post $post, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        switch($request->get('_route'))
        {
            case 'positive_post':
            $result = $this->positivePost($post);
            break;
            
            case 'negative_post':
            $result = $this->negativePost($post);
            break;

            case 'back_positive_post':
            $result = $this->backPositivePost($post);
            break;

            case 'back_negative_post':
            $result = $this->backNegativePost($post);
            break;
        }

        return $this->json(['action' => $result,'id'=>$post->getId()]);
    }


    /**
     * Add/remove positive/negative opinion to Database. Set case for 'opinion.js'.
     */
    private function positivePost($post)
    {  
        $entityManager= $this->doctrine->getManager();
        $user = $this->doctrine->getRepository(User::class)->find($this->getUser());
        $user->addPositiveOpinion($post);
        $entityManager->persist($user);
        $entityManager->flush();

        return 'positive';
    }
    
    private function negativePost($post)
    {
        $entityManager= $this->doctrine->getManager();
        $user = $this->doctrine->getRepository(User::class)->find($this->getUser());
        $user->addNegativeOpinion($post);
        $entityManager->persist($user);
        $entityManager->flush();

        return 'negative';
    }

    private function backPositivePost($post)
    {  
        $entityManager= $this->doctrine->getManager();
        $user = $this->doctrine->getRepository(User::class)->find($this->getUser());
        $user->removePositiveOpinion($post);
        $entityManager->persist($user);
        $entityManager->flush();

        return 'click-to-back-positive';
    }

    private function backNegativePost($post)
    {   
        $entityManager= $this->doctrine->getManager();
        $user = $this->doctrine->getRepository(User::class)->find($this->getUser());
        $user->removeNegativeOpinion($post);
        $entityManager->persist($user);
        $entityManager->flush();

        return 'click-to-back-negative';
    }

}
