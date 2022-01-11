<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransformCapsController extends AbstractController
{
    #[Route('/transform/caps', name: 'transform_caps')]
    public function index(): Response
    {
        return $this->render('transform_caps/index.html.twig', [
            'controller_name' => 'TransformCapsController',
        ]);
    }
}
