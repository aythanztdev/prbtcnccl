<?php


namespace App\Controller;


use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", methods={"POST"})
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        // ...
    }

    /**
     * @Route("/category/{id}", methods={"PUT"})
     *
     * @param Request $request
     * @param Category $id
     */
    public function edit(Request $request, Category $id)
    {
        // ...
    }

    /**
     * @Route("/category/{id}", methods={"DELETE"})
     *
     * @param Request $request
     * @param Category $id
     */
    public function delete(Request $request, Category $id)
    {
        // ...
    }
}