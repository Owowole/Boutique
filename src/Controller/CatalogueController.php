<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatalogueController extends AbstractController
{
    #[Route('/', name: 'catalogue_index', methods: ['GET'])]
    public function index(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'products' => $productRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/catalogue/category/{id}', name: 'catalogue_category', methods: ['GET'])]
    public function category(
        Category $category,
        CategoryRepository $categoryRepository
    ): Response
    {
        return $this->render('catalogue/category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
