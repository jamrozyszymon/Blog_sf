<?php

namespace App\Core\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * Display list of category in nav
     */
    public function displayCategories(ManagerRegistry $doctrine)
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();

        
        return $this->render('Category/category_tree.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/Category/display", name="category_display")
     */
    public function showCategory(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request)
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();

        $category = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1), 5
        );

        if (!$categories) {
            throw $this->createNotFoundException(
                'Brak kategorii do wyświelenia.'
            );
        }
        return $this->render('Category/display.html.twig', [
            'categories' => $category
        ]);
    }

    /**
     * @Route("/Category/display/{!page?1}", name="category_search_display")
     */
    public function showSearchCategory(ManagerRegistry $doctrine, $page, Request $request)
    {
        $category = $doctrine->getRepository(Category::class)
            ->findCategory($page, $request->get('searchby'));

        return $this->render('Category/display.html.twig', [
            'categories' => $category
        ]);
    }

}
