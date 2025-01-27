<?php

namespace App\Controller;

use App\Entity\ItemPresupuesto;
use App\Form\ItemPresupuestoType;
use App\Repository\ItemPresupuestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/item/presupuesto')]
final class ItemPresupuestoController extends AbstractController
{
    #[Route(name: 'app_item_presupuesto_index', methods: ['GET'])]
    public function index(ItemPresupuestoRepository $itemPresupuestoRepository): Response
    {
        return $this->render('item_presupuesto/index.html.twig', [
            'item_presupuestos' => $itemPresupuestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_item_presupuesto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $itemPresupuesto = new ItemPresupuesto();
        $form = $this->createForm(ItemPresupuestoType::class, $itemPresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itemPresupuesto);
            $entityManager->flush();

            return $this->redirectToRoute('app_item_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('item_presupuesto/new.html.twig', [
            'item_presupuesto' => $itemPresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_item_presupuesto_show', methods: ['GET'])]
    public function show(ItemPresupuesto $itemPresupuesto): Response
    {
        return $this->render('item_presupuesto/show.html.twig', [
            'item_presupuesto' => $itemPresupuesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_item_presupuesto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ItemPresupuesto $itemPresupuesto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ItemPresupuestoType::class, $itemPresupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_item_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('item_presupuesto/edit.html.twig', [
            'item_presupuesto' => $itemPresupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_item_presupuesto_delete', methods: ['POST'])]
    public function delete(Request $request, ItemPresupuesto $itemPresupuesto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemPresupuesto->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($itemPresupuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_item_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }
}
