<?php

namespace App\Controller;

use App\Entity\Status;
use App\Repository\StatusRepository;
use App\Repository\TicketsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(StatusRepository $statusRepository, TicketsRepository $ticketsRepository): Response
    {
        $status = $statusRepository->findAll();
        $tickets = $ticketsRepository->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'status' => $status,
            'tickets' => $tickets
        ]);
    }
    #[Route('/stats', name: 'app_stats')]
    public function stats(): Response
    {

        return $this->render('main/stats.html.twig', [
            'controller_name' => 'MainController',
        
        ]);
    }
}
