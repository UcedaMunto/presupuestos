<?php

namespace App\Controller;

use App\Entity\Referencia;
use App\Form\ReferenciaType;
use App\Repository\ReferenciaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/referencia')]
final class ReferenciaController extends AbstractController
{
    #[Route(name: 'app_referencia_index', methods: ['GET'])]
    public function index(ReferenciaRepository $referenciaRepository): Response
    {
        return $this->render('referencia/index.html.twig', [
            'referencias' => $referenciaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_referencia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $referencium = new Referencia();
        $form = $this->createForm(ReferenciaType::class, $referencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($referencium);
            $entityManager->flush();

            return $this->redirectToRoute('app_referencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('referencia/new.html.twig', [
            'referencium' => $referencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referencia_show', methods: ['GET'])]
    public function show(Referencia $referencium): Response
    {
        return $this->render('referencia/show.html.twig', [
            'referencium' => $referencium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_referencia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Referencia $referencium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReferenciaType::class, $referencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_referencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('referencia/edit.html.twig', [
            'referencium' => $referencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referencia_delete', methods: ['POST'])]
    public function delete(Request $request, Referencia $referencium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referencium->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($referencium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_referencia_index', [], Response::HTTP_SEE_OTHER);
    }
}
