<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(PostRepository $postRepository)
    {

        $post = $postRepository->findAll();
        return $this->render("/post/post.html.twig", ['post' => $post]);
    }

    #[Route('/post/{id}', name: 'app_post_show')]
    public function postShow($id, PostRepository $postRepository)
    {

        $post = $postRepository->find($id);
        return $this->render("/post/post.html.twig", ['post' => $post]);
    }
}
