<?php
namespace App\Controller;

use App\Entity\HomeBlock;
use App\Form\HomeBlockType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api", methods="GET")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/newForm", name="api_newForm", methods={"GET"})
     * @return JsonResponse
     */
    public function newAdminForm(Request $request)
    {
        $homeBlock = new HomeBlock();
        $formHome = $this->createForm(HomeBlockType::class, $homeBlock);
        $formHome->handleRequest($request);
//        dump($formHome->createView());
        return new JsonResponse($formHome->createView());
    }
}