<?php

namespace App\Controller;

use App\Entity\MetaTags;
use App\Form\MetaTagsType;
use App\Repository\MetaTagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/meta")
 */
class MetaTagsController extends AbstractController
{

    /**
     * @Route("/{url}/edit", name="meta_tags_edit", methods={"GET","POST"})
     * @ParamConverter("metaTag", options={"mapping": {"url" : "url"}})
     *
     */
    public function edit(Request $request, MetaTags $metaTag): Response
    {
        $form = $this->createForm(MetaTagsType::class, $metaTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }

        return $this->render('meta_tags/edit.html.twig', [
            'meta_tag' => $metaTag,
            'form' => $form->createView(),
        ]);
    }

}
