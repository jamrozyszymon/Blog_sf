<?php

namespace App\Core\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Cache\CacheInterface;

class CategoryController extends AbstractController
{
    /**
     * Display list of category in nav
     */
    public function displayCategories(EntityManagerInterface $entityManager, CacheInterface $cache)
    {
        $cache = $cache->cache;
        $categoriesList = $cache->getItem('categories_list_nav');
        $categoriesList->expiresAfter(5);

        if(!$categoriesList->isHit()) {
            $repository = $entityManager->getRepository(Category::class);
            $categories=$repository->findCategoryName();

            $response = $this->render('Category/category_tree.html.twig', [
                'categories' => $categories,
            ]);

            $categoriesList->set($response);
            $cache->save($categoriesList);
        }

        return $categoriesList->get();
    }


    /**
     * Display list of active categories with info about last post.
     * @Route("/Category/display", name="category_display")
     */
    public function showCategory(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request, CacheInterface $cache)
    {
        $cache = $cache->cache;
        $categoriesList = $cache->getItem('categories_list');
        $categoriesList->expiresAfter(5);

        if(!$categoriesList->isHit()) {
            $repository = $entityManager->getRepository(Category::class);
            $listCategories=$repository->findAllWithLastPost();
            $category = $paginator->paginate(
                $listCategories,
                $request->query->getInt('page',1), 12
            );

            $response =  $this->render('Category/display.html.twig', [
                'categories' => $category
            ]);

            $categoriesList->set($response);
            $cache->save($categoriesList);
        }

        return $categoriesList->get();
    }

    /**
     * Display categories by search with info about last post.
     * @Route("/Category/display/{!page?1}", name="category_search_display")
     */
    public function showSearchCategory(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request)
    {
        $repository = $entityManager->getRepository(Category::class);
        $listCategories=$repository->findBySearch($request->get('searchby'));
        $category = $paginator->paginate(
            $listCategories,
            $request->query->getInt('page',1), 12
        );

        return $this->render('Category/display.html.twig', [
            'categories' => $category
        ]);
    }

}
