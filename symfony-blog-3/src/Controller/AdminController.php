<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Entity\Image;
use App\Form\ImageFormType;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin/images", name="app_images")
    */
    public function images(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        
        $repository = $doctrine->getRepository(Image::class);

        $images = $repository->findAll();

        $image = new Image();
        $form = $this->createForm(ImageFormType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->getData();    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($image);
            $entityManager->flush();
        }
        return $this->render('admin/images.html.twig', array(
            'form' => $form->createView(),
            'images' => $images   
        ));
    }
    /**
    * @Route("/admin/categories", name="app_categories")
    */
    public function categories(ManagerRegistry $doctrine, Request $request): Response
    {
        $repositorio = $doctrine->getRepository(Category::class);

        $categories = $repositorio->findAll();

        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render('admin/categories.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories   
        ));

    }
}
