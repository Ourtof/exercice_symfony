<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    #[Route('/tag', name: 'app_tag')]
    public function index(TagRepository $tagRepository)
    {

        $tag = $tagRepository->findAll();
        return $this->render("/tag/tag.html.twig", ['tag' => $tag]);
    }

    #[Route('/tag/{id}', name: 'app_tag_show')]
    public function tagShow($id, TagRepository $tagRepository)
    {

        $tag = $tagRepository->find($id);
        return $this->render("/tag/tag.html.twig", ['tag' => $tag]);
    }
}
