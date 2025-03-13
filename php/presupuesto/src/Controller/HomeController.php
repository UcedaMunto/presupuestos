<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\PresupuestoRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PresupuestoRepository $presupuestoRepository): Response
    {
        return $this->render('presupuesto/index.html.twig', [
            'presupuestos' => $presupuestoRepository->findAll(),
        ]);
    }
}
