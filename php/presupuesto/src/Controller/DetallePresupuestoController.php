<?php

namespace App\Controller;

use App\Entity\DetallePresupuesto;
use App\Form\DetallePresupuestoType;
use App\Repository\DetallePresupuestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/detalle/presupuesto')]
final class DetallePresupuestoController extends AbstractController
{
    #[Route(name: 'app_detalle_presupuesto_index', methods: ['GET'])]
    public function index(DetallePresupuestoRepository $detallePresupuestoRepository): Response
    {
        return $this->render('detalle_presupuesto/index.html.twig', [
            'detalle_presupuestos' => $detallePresupuestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detalle_presupuesto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detallePresupuesto = new DetallePresupuesto();
        $form = $this->createForm(DetallePresupuestoType::class, $detallePresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detallePresupuesto);
            $entityManager->flush();

            return $this->redirectToRoute('app_detalle_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detalle_presupuesto/new.html.twig', [
            'detalle_presupuesto' => $detallePresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detalle_presupuesto_show', methods: ['GET'])]
    public function show(DetallePresupuesto $detallePresupuesto): Response
    {
        return $this->render('detalle_presupuesto/show.html.twig', [
            'detalle_presupuesto' => $detallePresupuesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detalle_presupuesto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetallePresupuesto $detallePresupuesto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetallePresupuestoType::class, $detallePresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_detalle_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detalle_presupuesto/edit.html.twig', [
            'detalle_presupuesto' => $detallePresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detalle_presupuesto_delete', methods: ['POST'])]
    public function delete(Request $request, DetallePresupuesto $detallePresupuesto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detallePresupuesto->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($detallePresupuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_detalle_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }
}
