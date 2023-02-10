<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrelloController extends AbstractController
{
    /**
     * @Route("/trello", name="app_trello")
     */
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);

        return $this->render('trello/index.html.twig', [
            'controller_name' => 'TrelloController',
            'monForm' =>$form->createView(),
        ]);
    }
}
