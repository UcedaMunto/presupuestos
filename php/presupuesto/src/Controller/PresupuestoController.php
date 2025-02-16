<?php

namespace App\Controller;

use App\Entity\Presupuesto;
use App\Form\PresupuestoType;
use App\Repository\PresupuestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/presupuesto')]
final class PresupuestoController extends AbstractController
{
    #[Route(name: 'app_presupuesto_index', methods: ['GET'])]
    public function index(PresupuestoRepository $presupuestoRepository): Response
    {
        return $this->render('presupuesto/index.html.twig', [
            'presupuestos' => $presupuestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_presupuesto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $presupuesto = new Presupuesto();
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($presupuesto);
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
            #return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('presupuesto/new.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presupuesto_show', methods: ['GET'])]
    public function show(Presupuesto $presupuesto): Response
    {
        return $this->render('presupuesto/show.html.twig', [
            'presupuesto' => $presupuesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presupuesto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presupuesto $presupuesto, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
            #return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('presupuesto/edit.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presupuesto_delete', methods: ['POST'])]
    public function delete(Request $request, Presupuesto $presupuesto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presupuesto->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($presupuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/productos', name: 'api_presupuesto_productos', methods: ['GET'])]
    public function getProductos(Request $request, int $id, PresupuestoRepository $presupuestoRepository): JsonResponse
    {
        $presupuesto = $presupuestoRepository->find($id);
        if (!$presupuesto) {
            return $this->json(['error' => 'Presupuesto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $productos = $presupuesto->getProductos();
        
        $data = array_map(fn($producto) => [
            'id' => $producto->getId(),
            'nombre' => $producto->getNombre(),
            'precio' => $producto->getPrecio(),
            'descripcion' => $producto->getDescripcion(),
            'unidadMedida' => $producto->getUnidadMedida(),
        ], $productos);
        
        return $this->json($data);
    }

    #[Route('/{id}/servicios', name: 'api_presupuesto_servicios', methods: ['GET'])]
    public function getServicios(Request $request,int $id, PresupuestoRepository $presupuestoRepository): JsonResponse
    {
        $presupuesto = $presupuestoRepository->find($id);
        if (!$presupuesto) {
            return $this->json(['error' => 'Presupuesto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $servicios = $presupuesto->getServicios();
        
        $data = array_map(fn($servicio) => [
            'id' => $servicio->getId(),
            'nombre' => $servicio->getNombre(),
            'precio' => $servicio->getPrecio(),
            'descripcion' => $servicio->getDescripcion(),
            'duracionMinutos' => $servicio->getDuracionMinutos(),
        ], $servicios);
        
        return $this->json($data);
    }
}
