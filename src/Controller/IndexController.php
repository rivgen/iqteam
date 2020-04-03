<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use App\Entity\HomeBlock;
use App\Entity\ImgArticles;
use App\Form\ContactType;
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
        $homeBlock = new HomeBlock();
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
        $formHome = $this->createForm(HomeBlockType::class, $homeBlock,  ['csrf_protection' => false]);
//        $formHome->handleRequest($request);
        $array = json_encode($liform->transform($formHome));
//        $array = json_encode($this->get('liform')->transform($formHome));
        dump($array);
        dump($form->createView());
//        dump($request);

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'images' => $images,
            'formContact' => $form->createView(),
            'formHome' => $formHome->createView(),
        ]);
    }

    /**
     * @Route("/json/{id}", name="index_json", methods="GET/POST")
     */
    public function indexJson($id){

    }

}