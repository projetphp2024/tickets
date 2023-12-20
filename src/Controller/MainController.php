<?php

namespace App\Controller;

use App\Entity\Status;
use App\Repository\StatusRepository;
use App\Repository\TicketsRepository;
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
}
