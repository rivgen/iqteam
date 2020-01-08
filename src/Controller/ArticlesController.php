<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ButtonArticles;
use App\Entity\ImgArticles;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploaderHelper;
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
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository->buttonInArticle();
        $categories = $articlesCategoryRepository->allCategory();
        $images = $imgArticlesRepository->imageInArticle();

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'categories' => $categories,
            'images' => $images
        ]);
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $uploadedFile = $form['iconFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadIcon($uploadedFile);
                $article->setIcon($newFilename);

            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
//            dd($article);
            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/show.html.twig', [
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
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $article = $articlesRepository->findArticle($id);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $button = $buttonArticlesRepository->findButton($id);
        $images = $imgArticlesRepository->findImage($id);
        $prevNext = $articlesRepository->filterNextPrevious($id);
        if (!empty($prevNext)) {
            if (empty($prevNext[1]) and $prevNext[0]['id'] > $id) {
                $endId = $articlesRepository->endId();
                array_unshift($prevNext, ['id' => $endId]);
            } elseif (empty($prevNext[1]) and $prevNext[0]['id'] < $id) {
                $startId = $articlesRepository->startId();
                array_push($prevNext, ['id' => $startId]);
            }
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'buttons' => $button,
            'prevNext' => $prevNext,
            'images' => $images
        ]);
    }

    /**
     * @Route("/{id}/edit", name="articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article, UploaderHelper $uploaderHelper, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $button = $buttonArticlesRepository->findButton($id);
        $prevNext = $articlesRepository->filterNextPrevious($id);
        $imgArticle = new ImgArticles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        $images = $imgArticlesRepository->findImage($id);;

        if (!empty($prevNext)) {
            if (empty($prevNext[1]) and $prevNext[0]['id'] > $id) {
                $endId = $articlesRepository->endId();
                array_unshift($prevNext, ['id' => $endId]);
            } elseif (empty($prevNext[1]) and $prevNext[0]['id'] < $id) {
                $startId = $articlesRepository->startId();
                array_push($prevNext, ['id' => $startId]);
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['iconFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadIcon($uploadedFile, $id);
                $article->setIcon($newFilename);

            }
            $uploadedImage = $form['imageFile']->getData();
            if ($uploadedImage) {
                $newImageName = $uploaderHelper->uploadIcon($uploadedImage, $id);
                $imgArticle->setImg($newImageName);
                $imgArticle->setArticle($article);
            }
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->persist($imgArticle);
            $entityManager->flush();

            return $this->redirectToRoute('articles_edit', ['id'=> $id]);
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'images' => $images,
            'buttons' => $button,
            'prevNext' => $prevNext,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="articles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }
}
