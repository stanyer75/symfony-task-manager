<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', methods:'GET')]
    public function tasks()
    {
        return $this->render('tasks.html.twig');
    }
}