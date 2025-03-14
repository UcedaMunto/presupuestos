<?php

namespace App\Controller;

use App\Entity\Servicio;
use App\Form\ServicioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/servicio')]
final class ServicioController extends AbstractController
{
    #[Route(name: 'app_servicio_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $servicios = $entityManager
            ->getRepository(Servicio::class)
            ->findAll();

        return $this->render('servicio/index.html.twig', [
            'servicios' => $servicios,
        ]);
    }

    #[Route('/new', name: 'app_servicio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $servicio = new Servicio();
        $form = $this->createForm(ServicioType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($servicio);
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
            #return $this->redirectToRoute('app_servicio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('servicio/new.html.twig', [
            'servicio' => $servicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_servicio_show', methods: ['GET'])]
    public function show(Servicio $servicio): Response
    {
        return $this->render('servicio/show.html.twig', [
            'servicio' => $servicio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_servicio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Servicio $servicio, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ServicioType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
            #return $this->redirectToRoute('app_servicio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('servicio/edit.html.twig', [
            'servicio' => $servicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_servicio_delete', methods: ['POST'])]
    public function delete(Request $request, Servicio $servicio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicio->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($servicio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_servicio_index', [], Response::HTTP_SEE_OTHER);
    }
}
