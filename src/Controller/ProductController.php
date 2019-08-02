<?php


namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductService;
use App\Service\UtilsService;
use App\Service\ValidateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    private $serializer;
    private $productService;
    private $validateService;
    private $utilsService;

    public function __construct(
        SerializerInterface $serializer,
        ProductService $productService,
        ValidateService $validateService,
        UtilsService $utilsService)
    {
        $this->serializer = $serializer;
        $this->productService = $productService;
        $this->validateService = $validateService;
        $this->utilsService = $utilsService;
    }

    /**
     * @Route("/product", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        $product = new Product();
        $data = json_decode($request->getContent(), true);
        $productPersisted = $this->processForm($product, $data);

        $productSerialized = $this->serializer->serialize($productPersisted, 'json', ['groups' => ['product']]);
        return new Response($productSerialized, Response::HTTP_CREATED) ;
    }

    /**
     * @Route("/products", methods={"GET"})
     *
     * @return Response
     */
    public function getAll(): Response
    {
        $products = $this->productService->findAll();

        $productsSerialized = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);
        return new Response($productsSerialized, Response::HTTP_OK) ;
    }

    /**
     * @Route("/products/featured", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAllFeatured(Request $request): Response
    {
        $products = $this->productService->findFeatured();

        if ($request->query->has('currency')) {
            $currency = $request->query->get('currency');
            $this->validateService->validateCurrency($currency);

            $products = $this->productService->calculatePriceWithCurrency($products, $currency);
        }

        $productsSerialized = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);
        return new Response($productsSerialized, Response::HTTP_OK) ;
    }

    private function processForm(Product $product, array $data) {
        $form = $this->createForm(ProductType::class, $product);
        $form->submit($data);

        if ($form->isValid()) {
            $this->productService->storeProduct($product);

            return $product;
        }

        $errors = $this->utilsService->getErrorsFromForm($form);
        $errorSerialized = $this->serializer->serialize($errors, 'json');
        throw new BadRequestHttpException($errorSerialized);
    }
}