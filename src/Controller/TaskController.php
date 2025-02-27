<?php 

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    #[Route('/tasks', methods:'GET')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $tasks = $entityManager->getRepository(Task::class)->findActiveTasks();

        return $this->render('tasks.html.twig', ['tasks' => $tasks]);
    }

    #[Route('/tasks', methods:'POST')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $task->setTitle($request->get('title'));

        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirect('/tasks');
    }

    #[Route('/tasks/{id}/toggle', methods: ['POST'])]
    public function markAsDone(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setIsDone(true);
        $entityManager->flush();

        return $this->json(['success' => true]);
    }

    #[Route('/tasks/{id}/delete', methods: ['GET'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setDeletedAt();
        $entityManager->flush();

        return $this->redirect('/tasks');
    }
}