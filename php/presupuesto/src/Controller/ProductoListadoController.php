<?php

namespace App\Controller;

use App\Entity\ProductoListado;
use App\Form\ProductoListadoType;
use App\Repository\ProductoListadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/productos/listado/{id_presupuesto}')]
final class ProductoListadoController extends AbstractController
{
    #[Route(name: 'app_producto_listado_index', methods: ['GET'])]
    public function index(ProductoListadoRepository $productoListadoRepository, PresupuestoRepository $presupuestoRepository, int $id_presupuesto): Response
    {

        return $this->render('producto_listado/index.html.twig', [
            'producto_listados' => $productoListadoRepository->findAll(),
            'id_presupuesto' => $id_presupuesto
        ]);
    }

    #[Route('/new', name: 'app_producto_listado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, $producto_consumido = null, EntityManagerInterface $entityManager): Response
    {
        
        $producto_consumido = $producto_consumido;


        $productoListado = new ProductoListado();
        $form = $this->createForm(ProductoListadoType::class, $productoListado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productoListado);
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_listado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('producto_listado/new.html.twig', [
            'producto_listado' => $productoListado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_producto_listado_show', methods: ['GET'])]
    public function show(ProductoListado $productoListado): Response
    {
        return $this->render('producto_listado/show.html.twig', [
            'producto_listado' => $productoListado,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_producto_listado_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductoListado $productoListado, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductoListadoType::class, $productoListado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_listado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('producto_listado/edit.html.twig', [
            'producto_listado' => $productoListado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_producto_listado_delete', methods: ['POST'])]
    public function delete(Request $request, ProductoListado $productoListado, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productoListado->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productoListado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_producto_listado_index', [], Response::HTTP_SEE_OTHER);
    }
}
