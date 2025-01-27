<?php

namespace App\Controller;

use App\Entity\EstadoPresupuesto;
use App\Form\EstadoPresupuestoType;
use App\Repository\EstadoPresupuestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/estado/presupuesto')]
final class EstadoPresupuestoController extends AbstractController
{
    #[Route(name: 'app_estado_presupuesto_index', methods: ['GET'])]
    public function index(EstadoPresupuestoRepository $estadoPresupuestoRepository): Response
    {
        return $this->render('estado_presupuesto/index.html.twig', [
            'estado_presupuestos' => $estadoPresupuestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_estado_presupuesto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $estadoPresupuesto = new EstadoPresupuesto();
        $form = $this->createForm(EstadoPresupuestoType::class, $estadoPresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($estadoPresupuesto);
            $entityManager->flush();

            return $this->redirectToRoute('app_estado_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('estado_presupuesto/new.html.twig', [
            'estado_presupuesto' => $estadoPresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estado_presupuesto_show', methods: ['GET'])]
    public function show(EstadoPresupuesto $estadoPresupuesto): Response
    {
        return $this->render('estado_presupuesto/show.html.twig', [
            'estado_presupuesto' => $estadoPresupuesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_estado_presupuesto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EstadoPresupuesto $estadoPresupuesto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EstadoPresupuestoType::class, $estadoPresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_estado_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('estado_presupuesto/edit.html.twig', [
            'estado_presupuesto' => $estadoPresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estado_presupuesto_delete', methods: ['POST'])]
    public function delete(Request $request, EstadoPresupuesto $estadoPresupuesto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estadoPresupuesto->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($estadoPresupuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_estado_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }
}
