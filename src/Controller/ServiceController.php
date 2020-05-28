<?php

namespace App\Controller;

use App\Entity\MetaTags;
use App\Entity\ServisBlok;
use App\Form\ServisBlockType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index", methods="GET")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $servisBlockRepository = $em->getRepository(ServisBlok::class);
        $metaTagsRepository = $em->getRepository(MetaTags::class);
        $servisBlocks = $servisBlockRepository->findAll();
        $metaTags = $metaTagsRepository->metaTag('service');
//        dump($servisBlocks);
        return $this->render('service/index.html.twig', [
            'servisBlocks' => $servisBlocks,
            'metaTags' => $metaTags,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ServisBlok $servisBlok, $id)
    {
        $formService = $this->createForm(ServisBlockType::class, $servisBlok);
        $formService->handleRequest($request);
        if ($formService->isSubmitted() && $formService->isValid()) {
//            $uploadedFile = $form['titleRu']->getData();
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($servisBlok);
            $entityManager->flush();
            return $this->redirectToRoute('service_index');
//            return $this->redirectToRoute('articles_edit', ['id'=> $id]);
        }
        return $this->render('service/edit.html.twig',[
            'formService' => $formService->createView(),
            'id' => $id
        ]);
    }

}