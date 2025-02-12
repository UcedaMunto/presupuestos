<?php

namespace App\Controller;

use App\Entity\ProgramacionConsumoIngreso;
use App\Form\ProgramacionConsumoIngresoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/programacion/consumo/ingreso')]
final class ProgramacionConsumoIngresoController extends AbstractController
{
    #[Route(name: 'app_programacion_consumo_ingreso_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $programacionConsumoIngresos = $entityManager
            ->getRepository(ProgramacionConsumoIngreso::class)
            ->findAll();

        return $this->render('programacion_consumo_ingreso/index.html.twig', [
            'programacion_consumo_ingresos' => $programacionConsumoIngresos,
        ]);
    }

    #[Route('/new', name: 'app_programacion_consumo_ingreso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $programacionConsumoIngreso = new ProgramacionConsumoIngreso();
        $form = $this->createForm(ProgramacionConsumoIngresoType::class, $programacionConsumoIngreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($programacionConsumoIngreso);
            $entityManager->flush();

            return $this->redirectToRoute('app_programacion_consumo_ingreso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programacion_consumo_ingreso/new.html.twig', [
            'programacion_consumo_ingreso' => $programacionConsumoIngreso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_programacion_consumo_ingreso_show', methods: ['GET'])]
    public function show(ProgramacionConsumoIngreso $programacionConsumoIngreso): Response
    {
        return $this->render('programacion_consumo_ingreso/show.html.twig', [
            'programacion_consumo_ingreso' => $programacionConsumoIngreso,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_programacion_consumo_ingreso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProgramacionConsumoIngreso $programacionConsumoIngreso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProgramacionConsumoIngresoType::class, $programacionConsumoIngreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_programacion_consumo_ingreso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programacion_consumo_ingreso/edit.html.twig', [
            'programacion_consumo_ingreso' => $programacionConsumoIngreso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_programacion_consumo_ingreso_delete', methods: ['POST'])]
    public function delete(Request $request, ProgramacionConsumoIngreso $programacionConsumoIngreso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programacionConsumoIngreso->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($programacionConsumoIngreso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_programacion_consumo_ingreso_index', [], Response::HTTP_SEE_OTHER);
    }
}
