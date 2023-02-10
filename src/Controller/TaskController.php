<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="app_task")
     */
    public function index(): Response
    {

        $task = new Task();
        $form = $this->createForm(TaskType::class,$task);


        return $this->render('task/index.html.twig', [
            'TaskForm' => $form ->createView(),
            'controller_name' => 'TaskController',
        ]);
    }
}
