<?php


namespace App\Service;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private $entityManager;
    private $productRepository;
    private $utilsService;

    public function __construct(
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        UtilsService $utilsService)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->utilsService = $utilsService;
    }

    public function storeProduct(Product $category)
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    public function findAll()
    {
        return $this->productRepository->findAll();
    }

    public function findFeatured()
    {
        return $this->productRepository->findBy(['deletedAt' => null, 'featured' => true]);
    }

    public function calculatePriceWithCurrency($products, string $currency)
    {
        $conversionValue = $this->utilsService->getConversionValueForCurrency($currency);

        foreach ($products as $product) {
            if (!$product instanceof Product)
                continue;

            if ($product->getCurrency() === $currency)
                continue;

            $product->setCurrency($currency);

            $priceCalculated = $product->getPrice()*$conversionValue;
            $priceFormatted = number_format($priceCalculated, 2);
            $product->setPrice($priceFormatted);
        }

        return $products;
    }
}