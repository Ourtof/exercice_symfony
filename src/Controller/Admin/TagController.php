<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TagType;

class TagController extends AbstractController
{
    #[Route('/admin/tag', name: 'admin_tag_list')]
    public function tagList(TagRepository $tagRepository): Response
    {

        $index = $tagRepository->findAll();

        return $this->render("admin/tag/index.html.twig", ['index' => $index]);
    }

    // CRUD

    // READ

    #[Route('/admin/tag/index/{id}', name: 'admin_tag_show')]
    public function tagShow($id, TagRepository $tagRepository)
    {

        $index = $tagRepository->find($id);

        return $this->render("admin/tag/index.html.twig", ['index' => $index]);
    }

    // CREATE

    #[Route('admin/create/tag', name: 'admin_tag_create')]
    public function tagCreate(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        // instanciation d'un nouvel article
        $tag = new Tag();

        // création du formulaire
        $form = $this->createForm(TagType::class, $tag);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $form->handleRequest($request);

        // condition de validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($tag);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_tag_list"
            return $this->redirectToRoute("admin_tag_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/tag/form.html.twig", ['form' => $form->createView()]);
    }

    // UPDATE

    #[Route('admin/update/tag/{id}', name: 'admin_tag_update')]
    public function tagUpdate($id, EntityManagerInterface $entityManagerInterface, Request $request, TagRepository $tagRepository)
    {

        // récupération d'un article grâce à son id
        $tag = $tagRepository->find($id);
        
        // création du formulaire
        $form = $this->createForm(TagType::class, $tag);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $form->handleRequest($request);

        // condition de validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($tag);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_tag_list"
            return $this->redirectToRoute("admin_tag_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/tag/form.html.twig", ['form' => $form->createView()]);
    }

    // DELETE

    #[Route('admin/delete/tag/{id}', name: 'admin_tag_delete')]
    public function deleteArticle($id, EntityManagerInterface $entityManagerInterface, TagRepository $tagRepository)
    {

        // récupération d'un article grâce à son id
        $tag = $tagRepository->find($id);

        // suppression de cet article
        $entityManagerInterface->remove($tag);

        // enregistrement dans la bdd
        $entityManagerInterface->flush();

        // redirection vers la route "admin_post_list"
        return $this->redirectToRoute("admin_tag_list");
    }
}
