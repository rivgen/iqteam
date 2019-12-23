<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index", methods="GET")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository -> buttonInArticle();

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button
        ]);
    }

}