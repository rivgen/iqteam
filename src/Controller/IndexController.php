<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use App\Entity\HomeBlock;
use App\Entity\HomeBlockText;
use App\Entity\ImgArticles;
use App\Form\ContactType;
use App\Form\HomeBlockTextType;
use App\Form\HomeBlockType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Limenius\Liform\Resolver;
use Limenius\Liform\Liform;
use Limenius\Liform\Transformer;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index", methods="GET")
     */
    public function index(Request $request, Liform $liform)
    {
        $homeBlock = new HomeBlockText();
//        $resolver = new Resolver();
//        dump(Articles::class);
//        $resolver->setTransformer('text', Transformer\StringTransformer::class);
//        $resolver->setTransformer('textarea', $this->get('liform.transformer.string'), 'textarea');
// more transformers you might need, for a complete list of what is used in Symfony
// see https://github.com/Limenius/LiformBundle/blob/master/Resources/config/transformers.xml
//        $liform = new Liform($resolver);
        $em = $this->getDoctrine()->getManager();
        $articlesRepository = $em->getRepository(Articles::class);
        $imgArticlesRepository = $em->getRepository(ImgArticles::class);
        $buttonArticlesRepository = $em->getRepository(ButtonArticles::class);
        $articles = $articlesRepository->articlesInCategory();
        $button = $buttonArticlesRepository -> buttonInArticle();
        $images = $imgArticlesRepository->imageInArticle();
        $url = $this->generateUrl('mail_index');
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST'
        ]);
        $formHome = $this->createForm(HomeBlockTextType::class, $homeBlock);
        $formHome->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $uploadedFile = $form['titleRu']->getData();
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($homeBlock);
            $entityManager->flush();
//            return $this->redirectToRoute('articles_edit', ['id'=> $id]);
        }

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'images' => $images,
            'formContact' => $form->createView(),
            'formHome' => $formHome->createView(),
        ]);
    }

}