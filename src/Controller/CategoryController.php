<?php


namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Service\CategoryService;
use App\Service\UtilsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryController extends AbstractController
{
    private $categoryService;
    private $serializer;
    private $utilsService;

    public function __construct(
        CategoryService $categoryService,
        SerializerInterface $serializer,
        UtilsService $utilsService)
    {
        $this->categoryService = $categoryService;
        $this->serializer = $serializer;
        $this->utilsService = $utilsService;
    }

    /**
     * @Route("/category", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        $category = new Category();
        $data = json_decode($request->getContent(), true);
        $categoryPersisted = $this->processForm($category, $data);

        $categorySerialized = $this->serializer->serialize($categoryPersisted, 'json', ['groups' => ['category']]);
        return new Response($categorySerialized, Response::HTTP_CREATED) ;
    }

    /**
     * @Route("/category/{id}", methods={"PUT"})
     *
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     */
    public function edit(Request $request, Category $category): Response
    {
        $data = json_decode($request->getContent(), true);
        $categoryPersisted = $this->processForm($category, $data);

        $categorySerialized = $this->serializer->serialize($categoryPersisted, 'json', ['groups' => ['category']]);
        return new Response($categorySerialized, Response::HTTP_OK) ;
    }

    /**
     * @Route("/category/{id}", methods={"DELETE"})
     *
     * @param Category $category
     *
     * @return Response
     */
    public function delete(Category $category): Response
    {
        $this->categoryService->softDeleteCategory($category);

        $categorySerialized = $this->serializer->serialize($category, 'json', ['groups' => ['category-deleted']]);
        return new Response($categorySerialized, Response::HTTP_OK) ;
    }

    private function processForm(Category $category, array $data): ?Category {
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data);

        if ($form->isValid()) {
            $this->categoryService->storeCategory($category);

            return $category;
        }

        $errors = $this->utilsService->getErrorsFromForm($form);
        $errorSerialized = $this->serializer->serialize($errors, 'json');
        throw new BadRequestHttpException($errorSerialized);
    }
}