<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgeController extends AbstractController
{
    private $articles = [
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
        if(is_numeric($age) && $age > 0) {
            return new Response("L'âge du capitaine est de " . $age . " an(s).");
        } else {
            return new Response("T'abuses, mets un chiffre et supérieur à 0 j'te dit.");
        };
    }

    #[Route('/poker/{number}', name: 'app_poker')]
    public function poker($number)
    {
        if(is_numeric($number) && $number > 17) {
            return new Response("Vous êtes autorisés à jouer");
        } elseif(!is_numeric($number)) {
            return new Response("METS UN CHIFFRE OH !");
        } else {
            return new Response("Vous ne pouvez pas jouer... Désolé");
        }
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function article($id)
    {
        if(array_key_exists($id, $this->articles)) {
            return new Response(print_r($this->articles[$id], true));
        } else {
            return new Response("L'article sélectionné n'existe pas");
        }

    }

    #[Route('/articledefini/{id}', name: 'app_articledefini')]
    public function articledefini($id)
    {
        return $this->render('article.html.twig', ['article' => $this->articles[$id]]);
    }

    #[Route('/article2', name: 'app_article2')]
    public function article2()
    {
        return $this->render('article2.html.twig', ['articles' => $this->articles]);
    }
}
