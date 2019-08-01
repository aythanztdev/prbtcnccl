<?php


namespace App\Service;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function storeCategory(Category $category)
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    public function softDeleteCategory(Category $category)
    {
        $category->setDeletedAt(new \DateTime('now'));

        $this->entityManager->flush();
    }
}