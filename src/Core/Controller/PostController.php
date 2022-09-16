<?php

namespace App\Core\Controller;

use App\Core\Services\CreatePost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Category;
use App\Entity\Post;
use App\Form\CreatePostType;

class PostController extends AbstractController
{
    /**
     * Display posts for category (include posts od soft delete users)
     * @Route("/Post/display/category/{categoryname},{id}", name="post_display")
     */
    public function showPost(ManagerRegistry $doctrine,  PaginatorInterface $paginator, Request $request, Category $id, CreatePost $createPost)
    {

        $posts = $doctrine->getRepository(Post::class)->findAllPostByID($id);
       
        $paginate = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 5
        );

        //create post
        $user = new User();
        $user=$this->getUser();

        $post = new Post();
        $form = $this->createForm(CreatePostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $createPost->create($request->get('create_post')['content'], $user, $id);

            return $this->redirect($request->getUri());
        }
        
        return $this->render('Post/display.html.twig', [
            'posts' => $paginate,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/Post/delete/{id}", name= "post_delete")
     */
    public function deletePost(ManagerRegistry $doctrine, Post $id)
    {
        $entityManagerInterface = $doctrine->getManager();
        $entityManagerInterface->remove($id);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('post_display');
    }

}
