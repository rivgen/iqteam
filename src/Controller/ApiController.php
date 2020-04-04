<?php
namespace App\Controller;

use App\Entity\HomeBlock;
use App\Entity\HomeBlockText;
use App\Form\HomeBlockType;
use Limenius\Liform\Liform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function newAdminForm(Request $request, Liform $liform)
    {
        $homeBlock = new HomeBlock();

        $formHome = $this->createForm(HomeBlockType::class, $homeBlock, ['csrf_protection' => false]);
//        $formHome->handleRequest($request);
        $resultJson = json_encode($liform->transform($formHome));
//        dump($formHome->createView());
        return new JsonResponse($resultJson);
    }

    /**
     * @Route("/newForm/val", name="api_newForm_val", methods={"GET", "POST"})
     * @return JsonResponse
     */
    public function AdminFormValue(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $homeBlockTextRepository = $em->getRepository(HomeBlockText::class);
        $data = $request->getContent();
        $data = json_decode($data);
        $checkmark = $data->val->checkmark;
        $idBlock = $data->val->idBlock;
        $homeBlockAll =  $homeBlockTextRepository->all($checkmark, $idBlock);
        $resultJson = json_encode($homeBlockAll[0]);
        return new JsonResponse($resultJson);
    }
}