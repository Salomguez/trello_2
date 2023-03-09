<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;
class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function index()
    {
        $title = $this->getUser();
        $tickets = $this->getDoctrine()->getRepository(Ticket::class)->findBy(['title' => $title]);
        return $this->render('homepage/index.html.twig', [
            'tickets' => $tickets
        ]);
    }
}
