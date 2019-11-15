<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index", methods="GET")
     */
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('index/index.html.twig', [
            'number' => $number,
        ]);
    }

}