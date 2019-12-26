<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ButtonArticles;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles_index", methods={"GET"})
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $articlesCategoryRepository = $em->getRepository(ArticlesCategory::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository -> buttonInArticle();
        $categories = $articlesCategoryRepository -> allCategory();

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="articles_show", methods={"GET"})
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $article = $articlesRepository->findArticle($id);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $button = $buttonArticlesRepository -> findButton($id);
        $prevNext = $articlesRepository->filterNextPrevious($id);
        dump($prevNext);

        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'buttons' => $button,
            'prevNext' => $prevNext
        ]);
    }

    /**
     * @Route("/{id}/edit", name="articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="articles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }
}
