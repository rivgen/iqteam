<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portfolio")
 */
class PortfolioController extends AbstractController
{
    /**
     * @Route("/", name="portfolio_index", methods="GET")
     */
    public function index()
    {

        return $this->render('portfolio/index.html.twig', [
        ]);
    }

}