<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransformDashController extends AbstractController
{
    #[Route('/transform/dash', name: 'transform_dash')]
    public function index(): Response
    {
        return $this->render('transform_dash/index.html.twig', [
            'controller_name' => 'TransformDashController',
        ]);
    }
}
