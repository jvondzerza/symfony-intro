<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Monolog\Logger;
use App\Services\TransformCaps;
use App\Services\TransformDash;
use App\Services\Master;

class MasterController extends AbstractController
{

    #[Route('/master', name: 'master')]
    public function index(RequestStack $requestStack): Response
    {
        $string = "Input some text and choose a transform method";
        $logger = new Logger('my_logger');

        $form = $this->createFormBuilder()
            ->add('string', TextType::class)
            ->add('transform', ChoiceType::class, [
                'choices' => [
                    'Caps' => 'caps',
                    'Dash' => 'dash'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($requestStack->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data['transform'] === 'caps') {
                $master = new Master(new TransformCaps(), $logger);
                $string = $master->edit($data['string']);
                $master->log($string);
            } elseif ($data['transform'] === 'dash') {
                $master = new Master(new TransformDash(), $logger);
                $string = $master->edit($data['string']);
                $master->log($string);
            }
        }

        return $this->renderForm('master/index.html.twig', [
            'form' => $form,
            'string' => $string,
        ]);
    }
}
