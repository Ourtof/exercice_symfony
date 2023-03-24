<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgeController extends AbstractController
{
    private $article = [
        1 => [
        "titre" => "Titre 1",
        "contenu" => "Lorem ipsum dolor sit,
        amet consectetur adipisicing elit.
        Voluptates, officiis praesentium amet vitae perspiciatis id,
        ducimus natus optio in molestiae,
        placeat harum veniam eaque obcaecati tempore adipisci ratione quos ut!",
        "id" => 1
        ],
        2 => [
        "titre" => "Titre 2",
        "contenu" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quisquam, doloribus tenetur minima recusandae amet
       obcaecati nisi omnis ullam accusantium quibusdam commodi iste sapiente incidunt unde dolore, sunt ducimus doloremque.",
        "id" => 2
        ],
        3 => [
        "titre" => "Titre 3",
        "contenu" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit magni quisquam accusamus! Dolore rerum fugit
       praesentium iste fugiat voluptatem ducimus sunt sit! Doloremque nisi ratione ex quod natus impedit id.",
        "id" => 3
        ]
    ];

    #[Route('/age/{age}', name: 'app_age')]
    public function age($age)
    {
        return new Response("L'âge du capitaine est de " . $age . " ans");
    }

    #[Route('/poker/{number}', name: 'app_poker')]
    public function poker($number)
    {
        if($number >= 18) {
            return new Response("vous êtes autorisés à jouer");
        } else {
            return new Response ("vous ne pouvez pas jouer... Désolé");
        } 
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function article($id)
    {
        if($id <= 3) {
            return new Response(print_r($this->article[$id], true));
        } else {
            return new Response("L'article sélectionné n'existe pas");
        }
    }
}
