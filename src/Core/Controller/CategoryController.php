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
        $categoriesList->expiresAfter(3600);

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
    public function showCategory(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request)
    {
        $categoriesAll = $doctrine->getRepository(Category::class)->findAllWithLastPost();
        $categories = $paginator->paginate(
            $categoriesAll,
            $request->query->getInt('page',1), 12);

        return $response =  $this->render('Category/display.html.twig', [
                'categories' => $categories
            ]);
    }

     /**
     * Display list of top 15 categories with info about last post.
     * @Route("/Category/top", name="category_top")
     */
    public function showTopCategory(ManagerRegistry $doctrine, CacheInterface $cache)
    {
        $cache = $cache->cache;
        $categoriesList = $cache->getItem('categories_list_top');
        $categoriesList->expiresAfter(3600);

        if(!$categoriesList->isHit()) {
            $categoriesTop = $doctrine->getRepository(Category::class)->findTopWithLastPost();

            $response =  $this->render('Category/display-top.html.twig', [
                'categories' => $categoriesTop
            ]);

            $categoriesList->set($response);
            $cache->save($categoriesList);
        }
        return $categoriesList->get();
    }

    /**
     * Display categories by search with info about last post.
     * @Route("/Category/display", name="category_search_display")
     */
    public function showSearchCategory(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request)
    {
        $categoriesAll = $doctrine->getRepository(Category::class)->findBySearch($request->get('searchby'));
        $category = $paginator->paginate(
            $categoriesAll,
            $request->query->getInt('page',1), 12
        );

        return $this->render('Category/display.html.twig', [
            'categories' => $category
        ]);
    }

}
