<?php 

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    #[Route('/tasks', methods:'GET')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $tasks = $entityManager->getRepository(Task::class)->findAll();

        return $this->render('tasks.html.twig', ['tasks' => $tasks]);
    }

    #[Route('/tasks', methods:'POST')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $task->setTitle($request->get('title'));

        $entityManager->persist($task);
        $entityManager->flush();

        $tasks = $entityManager->getRepository(Task::class)->findAll();

        return $this->render('tasks.html.twig', ['tasks' => $tasks]);
    }
}