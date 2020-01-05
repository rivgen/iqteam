<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use App\Entity\ImgArticles;
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
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository -> buttonInArticle();
        $images = $imgArticlesRepository->imageInArticle();

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'images' => $images
        ]);
    }

}