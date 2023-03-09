<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\CreateTicketType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="app_ticket")
     */

    public function setuser(UserInterface $user)
    {
        $this->user = $user;
    }


    public function create(Request $request, UserInterface $user)
    {
        $ticket = new Ticket();
        $form = $this->createForm(CreateTicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $ticket->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('ticket/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $form = $this->createForm(UpdateTicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('ticket/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

