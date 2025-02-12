<?php

namespace App\Controller;

use App\Entity\TipoProducto;
use App\Form\TipoProductoType;
use App\Repository\TipoProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tipo/producto')]
final class TipoProductoController extends AbstractController
{
    #[Route(name: 'app_tipo_producto_index', methods: ['GET'])]
    public function index(TipoProductoRepository $tipoProductoRepository): Response
    {
        return $this->render('tipo_producto/index.html.twig', [
            'tipo_productos' => $tipoProductoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tipo_producto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tipoProducto = new TipoProducto();
        $form = $this->createForm(TipoProductoType::class, $tipoProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoProducto);
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_producto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_producto/new.html.twig', [
            'tipo_producto' => $tipoProducto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_producto_show', methods: ['GET'])]
    public function show(TipoProducto $tipoProducto): Response
    {
        return $this->render('tipo_producto/show.html.twig', [
            'tipo_producto' => $tipoProducto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tipo_producto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoProducto $tipoProducto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TipoProductoType::class, $tipoProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_producto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_producto/edit.html.twig', [
            'tipo_producto' => $tipoProducto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_producto_delete', methods: ['POST'])]
    public function delete(Request $request, TipoProducto $tipoProducto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoProducto->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tipoProducto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tipo_producto_index', [], Response::HTTP_SEE_OTHER);
    }
}
