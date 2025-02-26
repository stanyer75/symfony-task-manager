<?php 

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use \Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    #[Route('/tasks', methods:'GET')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $tasks = $entityManager->getRepository(Task::class)->findAll();

        return $this->render('tasks.html.twig', ['tasks' => $tasks]);
    }
}