<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Post;
use App\Form\AddPostType;
use Doctrine\Persistence\ManagerRegistry;

class DashboardController extends AbstractController
{
    /**
     *  @Route ("/profile/dashboard", name="dashboard")
     */
    public function index()
    {
        $user = new User();
        $user=$this->getUser();
        $emailGet = $user->getEmail();
        return $this->render('User/dashboard.html.twig', ['emailGet'=>$emailGet]);
        
    }

    /**
     * Soft delete account by users
     * @Route("/profile/delete-acount", name="delete_account")
     */
    public function deleteAccount(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($this->getUser());
        $entityManager->remove($user);
        $entityManager->flush();

        session_destroy();
        return $this->redirectToRoute('home');
    }
}
