<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use App\Entity\HomeBlock;
use App\Entity\ImgArticles;
use App\Entity\MetaTags;
use App\Form\ContactType;
use App\Form\HomeBlockType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index", methods="GET")
     * @Route("/{_locale}", name="locale_index", methods="GET")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $metaTagsRepository = $em->getRepository(MetaTags::class);
        $homeBlockRepository = $em->getRepository(HomeBlock::class);
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $articles = $articlesRepository->articlesInCategory();
        $metaTags = $metaTagsRepository->metaTag('home');
        $button = $buttonArticlesRepository -> buttonInArticle();
        $images = $imgArticlesRepository->imageInArticle();
        $mainHomeBlocks = $homeBlockRepository->all();
        $blocks = $homeBlockRepository->allBlock();
        $locale = $request->getLocale();;
//        dump($locale);

        $blockHome = [];
        foreach ($blocks as $block) {
            foreach ($mainHomeBlocks as $key => $mainHome) {
                $blockHome[$block['id']]['id'] = $block['id'];
                $blockHome[$block['id']]['titleRu'] = $block['titleRu'];
                $blockHome[$block['id']]['titleEn'] = $block['titleEn'];
                if ($block['id'] == $mainHome['id']){
                    $blockHome[$block['id']]['blocks'][] = $mainHome;
                }
            }
        }
//        dump($metaTags);

        $url = $this->generateUrl('mail_index');
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST'
        ]);


        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'images' => $images,
            'blockHome' => $blockHome,
            'formContact' => $form->createView(),
            'metaTags' => $metaTags,
//            'formHome' => $formHome->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="index_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HomeBlock $homeBlock, $id)
    {
        $formHome = $this->createForm(HomeBlockType::class, $homeBlock);
        $formHome->handleRequest($request);
        if ($formHome->isSubmitted() && $formHome->isValid()) {
//            $uploadedFile = $form['titleRu']->getData();
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($homeBlock);
            $entityManager->flush();
            return $this->redirectToRoute('index_index');
//            return $this->redirectToRoute('articles_edit', ['id'=> $id]);
        }
        return $this->render('index/edit.html.twig',[
            'formHome' => $formHome->createView(),
            'id' => $id
        ]);
    }

}