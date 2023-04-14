<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PostType;
use Doctrine\ORM\EntityManager;

class AdminArticleController extends AbstractController
{
    #[Route('/admin/posts', name: 'admin_post_list')]
    public function postList(PostRepository $postRepository): Response
    {

        $posts = $postRepository->findAll();

        return $this->render("admin/posts.html.twig", ['posts' => $posts]);
    }

    #[Route('/admin/post/{id}', name: 'admin_post_show')]
    public function postShow($id, PostRepository $postRepository)
    {

        $post = $postRepository->find($id);

        return $this->render("admin/post.html.twig", ['post' => $post]);
    }

    // CRUD

    // CREATE

    #[Route('admin/create/post', name: 'postform_create')]
    public function postCreate(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        // instanciation d'un nouvel article
        $post = new Post();

        // création du formulaire
        $postForm = $this->createForm(PostType::class, $post);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $postForm->handleRequest($request);

        // condition de validation du formulaire
        if ($postForm->isSubmitted() && $postForm->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($post);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_post_list"
            return $this->redirectToRoute("admin_post_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/postform.html.twig", ['postForm' => $postForm->createView()]);
    }

    // UPDATE

    #[Route('admin/update/post/{id}', name: 'postform_update')]
    public function postUpdate($id, EntityManagerInterface $entityManagerInterface, Request $request, PostRepository $postRepository)
    {

        // récupération d'un article grâce à son id
        $post = $postRepository->find($id);
        
        // création du formulaire
        $postForm = $this->createForm(PostType::class, $post);

        // récupération des données pour les relier au formulaire
        // grâce à la classe Request
        $postForm->handleRequest($request);

        // condition de validation du formulaire
        if ($postForm->isSubmitted() && $postForm->isValid()) {

            // enregistrement des données dans la bdd avec persist et flush
            $entityManagerInterface->persist($post);
            $entityManagerInterface->flush();

            // redirection vers la route "admin_post_list"
            return $this->redirectToRoute("admin_post_list");
        }

        // affichage de la vue qui contient le formulaire
        return $this->render("admin/postform.html.twig", ['postForm' => $postForm->createView()]);
    }

    // DELETE

    #[Route('admin/delete/post/{id}', name: 'postform_delete')]
    public function deleteArticle($id, EntityManagerInterface $entityManagerInterface, PostRepository $postRepository)
    {

        // récupération d'un article grâce à son id
        $post = $postRepository->find($id);

        // suppression de cet article
        $entityManagerInterface->remove($post);

        // enregistrement dans la bdd
        $entityManagerInterface->flush();

        // redirection vers la route "admin_post_list"
        return $this->redirectToRoute("admin_post_list");
    }
}
