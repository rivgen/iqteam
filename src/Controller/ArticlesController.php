<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ButtonArticles;
use App\Entity\ImgArticles;
use App\Entity\MetaTags;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploaderHelper;
/**
 * @Route("/{_locale}/articles")
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
        $metaTagsRepository = $em->getRepository(MetaTags::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository->buttonInArticle();
        $categories = $articlesCategoryRepository->allCategory();
        $images = $imgArticlesRepository->imageInArticle();
        $metaTags = $metaTagsRepository->metaTag('article');

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'categories' => $categories,
            'images' => $images,
            'metaTags' => $metaTags,
        ]);
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $article = new Articles();
        $imgArticle = new ImgArticles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
//        $array = json_decode(json_encode($form->createView()),TRUE);
//        dump($array);
//        dump($form->createView());
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $uploadedFile = $form['iconFile']->getData();
            $em = $this->getDoctrine();
            $entityManager = $em->getManager();

//


            $entityManager->persist($article);
            $entityManager->flush();
            $id = $article->getId();
            if (isset($uploadedFile)) {
                $newFilename = $uploaderHelper->uploadIcon($uploadedFile, $id);
                $article->setIcon($newFilename);
                $entityManager->persist($article);
            }
            $uploadedImage = $form['imageFile']->getData();
            if (isset($uploadedImage)) {
                $newImageName = $uploaderHelper->uploadIcon($uploadedImage, $id);
                $imgArticle->setImg($newImageName);
                $imgArticle->setArticle($article);
                $imgArticle->setGeneral(true);
                $entityManager->persist($imgArticle);
            }
            if (isset($uploadedFile) or isset($uploadedImage)){
                $entityManager->flush();
            }

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
        if (!preg_match('/^\+?\d+$/', $id)){
//            dump($id);
            $id = $articlesRepository->findArticleId($id);
        }

        $article = $articlesRepository->findArticle($id);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $button = $buttonArticlesRepository->findButton($id);
        $images = $imgArticlesRepository->findAllImage($id);
        $prevNext = $articlesRepository->filterNextPrevious($id);
        if (!empty($prevNext)) {
            if (empty($prevNext[1]) and $prevNext[0]['id'] > $id) {
                $endId = $articlesRepository->endId();
                $alias = $articlesRepository->findArticle($endId);
                array_unshift($prevNext, ['id' => $endId, 'alias' => $alias['alias']]);
            } elseif (empty($prevNext[1]) and $prevNext[0]['id'] < $id) {
                $startId = $articlesRepository->startId();
                $alias = $articlesRepository->findArticle($startId);
                array_push($prevNext, ['id' => $startId, 'alias' => $alias['alias']]);
            }
        };
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
    public function edit(Request $request, Articles $articles, UploaderHelper $uploaderHelper, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $button = $buttonArticlesRepository->findButton($id);
        $prevNext = $articlesRepository->filterNextPrevious($id);
        $imgArticle = new ImgArticles();
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);
        $images = $imgArticlesRepository->findAllImage($id);
        $general = false;
        foreach ($images as $image){
            if ($image['general']){
                $general = $image['general'];
            }
        }
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
                $articles->setIcon($newFilename);

            }
            $uploadedImage = $form['imageFile']->getData();
            if (isset($uploadedImage)) {
                $newImageName = $uploaderHelper->uploadIcon($uploadedImage, $id);
                $imgArticle->setImg($newImageName);
                $imgArticle->setArticle($articles);
                if (!$general){
                    $imgArticle->setGeneral(true);
                }
            }
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($articles);
            if(isset($uploadedImage)) {
                $entityManager->persist($imgArticle);
            }
            $entityManager->flush();

            return $this->redirectToRoute('articles_edit', ['id'=> $id]);
        }

        return $this->render('articles/show.html.twig', [
            'article' => $articles,
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
