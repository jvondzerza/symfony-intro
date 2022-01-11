<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class LearningController extends AbstractController
{

    #[Route('/about-becode', name: 'aboutMe')]
    public function aboutMe(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        $session->get('name') ?
            $response = $this->render('learning/about.html.twig', [
                'name' => $session->get('name'),
                'date' => new \DateTime(),
            ]) :
            $response = $this->forward('App\Controller\LearningController::changeMyName', [
                'name' => $requestStack->getSession()->get('name'),
                'date' => new \DateTime(),
            ]);

        return $response;

    }

    #[Route('/', name: 'home')]
    #[Route('/change-my-name', name: 'changeMyName', methods: ['POST'])]
    public function changeMyName(RequestStack $requestStack): Response {
        $session = $requestStack->getSession();
        $user = new User();
        $session->get('name') ?
            $user->setName($session->get('name')) :
            $user->setName("Unknown");

        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('changeMyName'))
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($requestStack->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $session->set('name', $user->getName());
            return $this->redirectToRoute('home');
        }

        return $this->renderForm('learning/index.html.twig', [
            'form' => $form,
            'name' => $session->get('name'),
        ]);
    }
}
