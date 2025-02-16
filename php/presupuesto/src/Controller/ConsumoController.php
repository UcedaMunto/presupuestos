<?php

namespace App\Controller;

use App\Entity\Consumo;
use App\Entity\Presupuesto;
use App\Form\ConsumoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/consumo')]
final class ConsumoController extends AbstractController
{
    #[Route(name: 'app_consumo_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $consumos = $entityManager
            ->getRepository(Consumo::class)
            ->findAll();

        return $this->render('consumo/index.html.twig', [
            'consumos' => $consumos,
        ]);
    }

    #[Route('/new', name: 'app_consumo_new', methods: ['GET', 'POST'])] 
    public function new(Request $request, EntityManagerInterface $entityManager )
    {
        $presupuestoId = $request->query->get('id_presupuesto');
        $presupuesto = $entityManager->getRepository(Presupuesto::class)->find( $presupuestoId);

        if (!$presupuesto) {
            throw $this->createNotFoundException('Presupuesto no encontrado');
        }

        $consumo = new Consumo();
        $consumo->setPresupuesto($presupuesto); // Asigna el presupuesto

        $form = $this->createForm(ConsumoType::class, $consumo, [
            'presupuesto' => $presupuesto,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consumo);
            $entityManager->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return $this->render('consumo/_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_consumo_show', methods: ['GET'])]
    public function show(Consumo $consumo): Response
    {
        return $this->render('consumo/show.html.twig', [
            'consumo' => $consumo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consumo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consumo $consumo, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ConsumoType::class, $consumo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
            #return $this->redirectToRoute('app_consumo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consumo/edit.html.twig', [
            'consumo' => $consumo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consumo_delete', methods: ['POST'])]
    public function delete(Request $request, Consumo $consumo, EntityManagerInterface $entityManager)
    {
        if ($this->isCsrfTokenValid('delete'.$consumo->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($consumo);
            $entityManager->flush();
        }
        return new JsonResponse(['status' => 'success']);
        #return $this->redirectToRoute('app_consumo_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/presupuesto/{id}', name: 'app_consumo_presupuesto', methods: ['GET'])]
    public function getConsumosByPresupuesto(int $id, EntityManagerInterface $entityManager): Response
    {
        $presupuesto = $entityManager->getRepository(Presupuesto::class)->find($id);

        if (!$presupuesto) {
            throw $this->createNotFoundException('Presupuesto no encontrado');
        }

        $consumos = $entityManager->getRepository(Consumo::class)->findBy(['presupuesto' => $presupuesto]);

        $data = [];
        foreach ($consumos as $consumo) {
            if ($consumo->getProducto() != null || $consumo->getServicio() != null) {
                if ($consumo->getProducto() != null) {
                    $nombre = $consumo->getProducto()->getNombre();
                    $tipo = $consumo->getProducto()->getTipoProducto() ? $consumo->getProducto()->getTipoProducto()->getNombre() : null;
                    $total = $consumo->getProducto()->getPrecio();
                } else {
                    $nombre = $consumo->getServicio()->getNombre();
                    $tipo = $consumo->getServicio()->getTipoProducto() ? $consumo->getServicio()->getTipoProducto()->getNombre() : null;
                    $total = $consumo->getServicio()->getPrecio();
                }

                $data[] = [
                    'id' => $consumo->getId(),
                    'fecha' => $consumo->getFecha(),
                    'presupuesto' => $presupuesto->getNombre(),
                    'nombre' => $nombre,
                    'tipo' => $tipo,
                    'cantidad' => $consumo->getCantidad(),
                    'costo_consumo' => $consumo->getTotal(),
                    'costo_prod_servicio' => $total,
                    'descripcion' => $consumo->getDescripcion(),
                ];
            }
        }

        return $this->render('consumo/data_consumos_prod_serv.html.twig', [
            'presupuesto' => $presupuesto,
            'consumos' => $data,
        ]);
        
    }
}
