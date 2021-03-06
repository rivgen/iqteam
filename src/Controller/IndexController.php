<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ButtonArticles;
use App\Entity\Docks;
use App\Entity\HomeBlock;
use App\Entity\ImgArticles;
use App\Entity\MetaTags;
use App\Entity\Subscription;
use App\Form\ContactType;
use App\Form\DocksType;
use App\Form\HomeBlockType;
use App\Form\SubscriptionType;
use App\Repository\DocksRepository;
use App\Service\UploaderHelper;
use PhpParser\Comment\Doc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

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

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'buttons' => $button,
            'images' => $images,
            'blockHome' => $blockHome,
            'metaTags' => $metaTags,
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

    /**
     * @Route("/docks/{id}/edit", name="docks_edit", methods={"GET","POST"})
     */
    public function docksEdit(Request $request, Docks $docks, UploaderHelper $uploaderHelper, $id)
    {
        $formDocks = $this->createForm(DocksType::class, $docks, [
            'action' => $this->generateUrl('docks_edit', ['id' => $id]),
        ]);
        $formDocks->handleRequest($request);
        if ($formDocks->isSubmitted() && $formDocks->isValid()) {
            $uploadedFileEn = $formDocks['enFile']->getData();
            $uploadedFileRu = $formDocks['ruFile']->getData();
            if ($uploadedFileEn) {
                $newFilename = $uploaderHelper->uploadDocks($uploadedFileEn);
                $docks->setEn($newFilename);

            }
            if ($uploadedFileRu) {
                $newFilename = $uploaderHelper->uploadDocks($uploadedFileRu);
                $docks->setRu($newFilename);

            }
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($docks);
            if(isset($uploadedFileEn) or isset($uploadedFileRu) ) {
                $entityManager->persist($docks);
            }
            $entityManager->flush();
            return $this->redirectToRoute('index_index');
        }
        return $this->render('_docksForm.html.twig',[
            'formDocks' => $formDocks->createView(),
//            'qwer' => 'qwert12331313'
        ]);
    }

    public function docksUrl($id, $local)
    {
        $em = $this->getDoctrine()->getManager();
        $docksRepository = $em->getRepository(Docks::class);
        $url = $docksRepository->searchDocks($id, $local);
        return new Response($url);
    }

    public function contact()
    {
        $url = $this->generateUrl('mail_index');
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST',
            'attr' => ['class'=>'form-contact']
        ]);
        return $this->render('_contactForm.html.twig', [
            'formContact' => $form->createView(),
        ]);
    }

    public function subscription()
    {
        $url = $this->generateUrl('subscription_base_edit');
        $form = $this->createForm(SubscriptionType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST',
            'attr' => ['class'=>'form-subscription']
        ]);
        return $this->render('_subscriptionForm.html.twig', [
            'formSubscription' => $form->createView(),
        ]);
    }

    public function message(){
        $message = null;
        if($this->session->has('message')){
            $message = $this->session->get('message');
        }
//        $this->session->clear();
        return $this->render('_message.html.twig', [
            'message' => $message,
        ]);
    }
}