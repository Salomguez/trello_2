<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="app_task")
     */
    public function task (
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class,$task);
        $form->handleRequest($request);

        if ($form->isSubmitted () && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
        }

        return $this->render('task/index.html.twig', [
            'TaskForm' => $form ->createView(),
            'controller_name' => 'TaskController',
        ]);
    }
}
