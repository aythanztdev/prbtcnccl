<?php


namespace App\Controller;


use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", methods={"POST"})
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        // ...
    }

    /**
     * @Route("/products", methods={"GET"})
     *
     * @param Request $request
     */
    public function getAll(Request $request)
    {
        // ...
    }

    /**
     * @Route("/products/featured", methods={"GET"})
     *
     * @param Request $request
     */
    public function getFeatured(Request $request)
    {
        // ...
    }
}