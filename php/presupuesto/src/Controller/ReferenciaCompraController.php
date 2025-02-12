<?php

namespace App\Controller;

use App\Entity\ReferenciaCompra;
use App\Form\ReferenciaCompraType;
use App\Repository\ReferenciaCompraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/referencia/compra')]
final class ReferenciaCompraController extends AbstractController
{
    #[Route(name: 'app_referencia_compra_index', methods: ['GET'])]
    public function index(ReferenciaCompraRepository $referenciaCompraRepository): Response
    {
        return $this->render('referencia_compra/index.html.twig', [
            'referencia_compras' => $referenciaCompraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_referencia_compra_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $referenciaCompra = new ReferenciaCompra();
        $form = $this->createForm(ReferenciaCompraType::class, $referenciaCompra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($referenciaCompra);
            $entityManager->flush();

            return $this->redirectToRoute('app_referencia_compra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('referencia_compra/new.html.twig', [
            'referencia_compra' => $referenciaCompra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referencia_compra_show', methods: ['GET'])]
    public function show(ReferenciaCompra $referenciaCompra): Response
    {
        return $this->render('referencia_compra/show.html.twig', [
            'referencia_compra' => $referenciaCompra,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_referencia_compra_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReferenciaCompra $referenciaCompra, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReferenciaCompraType::class, $referenciaCompra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_referencia_compra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('referencia_compra/edit.html.twig', [
            'referencia_compra' => $referenciaCompra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referencia_compra_delete', methods: ['POST'])]
    public function delete(Request $request, ReferenciaCompra $referenciaCompra, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referenciaCompra->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($referenciaCompra);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_referencia_compra_index', [], Response::HTTP_SEE_OTHER);
    }
}
