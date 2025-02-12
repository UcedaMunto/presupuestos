<?php

namespace App\Controller;

use App\Entity\TipoServicio;
use App\Form\TipoServicioType;
use App\Repository\TipoServicioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tipo/servicio')]
final class TipoServicioController extends AbstractController
{
    #[Route(name: 'app_tipo_servicio_index', methods: ['GET'])]
    public function index(TipoServicioRepository $tipoServicioRepository): Response
    {
        return $this->render('tipo_servicio/index.html.twig', [
            'tipo_servicios' => $tipoServicioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tipo_servicio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tipoServicio = new TipoServicio();
        $form = $this->createForm(TipoServicioType::class, $tipoServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoServicio);
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_servicio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_servicio/new.html.twig', [
            'tipo_servicio' => $tipoServicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_servicio_show', methods: ['GET'])]
    public function show(TipoServicio $tipoServicio): Response
    {
        return $this->render('tipo_servicio/show.html.twig', [
            'tipo_servicio' => $tipoServicio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tipo_servicio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoServicio $tipoServicio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TipoServicioType::class, $tipoServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_servicio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_servicio/edit.html.twig', [
            'tipo_servicio' => $tipoServicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_servicio_delete', methods: ['POST'])]
    public function delete(Request $request, TipoServicio $tipoServicio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoServicio->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tipoServicio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tipo_servicio_index', [], Response::HTTP_SEE_OTHER);
    }
}
