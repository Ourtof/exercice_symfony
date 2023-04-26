<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    #[Route('/admin/category/index', name: 'admin_category_list')]
    public function categoryList(CategoryRepository $categoryRepository): Response
    {
        
        $index = $categoryRepository->findAll();

        return $this->render('admin/category/index.html.twig', ['index' => $index]);
    }

    // CRUD

    // READ

    #[Route('/admin/category/index/{id}', name: 'admin_category_show')]
    public function categoryShow($id, CategoryRepository $categoryRepository)
    {

        $index = $categoryRepository->find($id);

        return $this->render("admin/category/index.html.twig", ['index' => $index]);
    }

    // CREATE

    #[Route('admin/create/category', name: 'admin_category_create')]
    public function categoryCreate(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        // instanciation d'un nouvel article
        $category = new Category();

        // création du formulaire
        $form = $this->createForm(CategoryType::class, $category);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $form->handleRequest($request);

        // condition de validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($category);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_category_list"
            return $this->redirectToRoute("admin_category_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/category/form.html.twig", ['form' => $form->createView()]);
    }

    // UPDATE

    #[Route('admin/update/category/{id}', name: 'admin_category_update')]
    public function categoryUpdate($id, EntityManagerInterface $entityManagerInterface, Request $request, CategoryRepository $categoryRepository)
    {

        // récupération d'un article grâce à son id
        $category = $categoryRepository->find($id);
        
        // création du formulaire
        $form = $this->createForm(CategoryType::class, $category);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $form->handleRequest($request);

        // condition de validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($category);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_category_list"
            return $this->redirectToRoute("admin_category_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/category/form.html.twig", ['form' => $form->createView()]);
    }

    // DELETE

    #[Route('admin/delete/category/{id}', name: 'admin_category_delete')]
    public function deleteCategory($id, EntityManagerInterface $entityManagerInterface, CategoryRepository $categoryRepository)
    {
        // récupération d'un article grâce à son id
        $category = $categoryRepository->find($id);

        // suppression de cet article
        $entityManagerInterface->remove($category);

        // enregistrement dans la bdd
        $entityManagerInterface->flush();

        // redirection vers la route "admin_category_list"
        return $this->redirectToRoute("admin_category_list");
    }
}
