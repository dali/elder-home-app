<?php

namespace App\Controller\Admin;

use App\Entity\Resident;
use App\Form\ResidentType;
use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/residents")
 */
class ResidentController extends AbstractController
{
    /**
     * @Route("/", name="resident_index", methods={"GET"})
     */
    public function index(ResidentRepository $residentRepository): Response
    {
        return $this->render('admin/resident/index.html.twig', [
            'residents' => $residentRepository->findResidentsWithFamilies(),
        ]);
    }

    /**
     * @Route("/new", name="resident_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resident = new Resident();
        $form = $this->createForm(ResidentType::class, $resident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resident);
            $entityManager->flush();

            return $this->redirectToRoute('resident_index');
        }

        return $this->render('admin/resident/new.html.twig', [
            'resident' => $resident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resident_show", methods={"GET"})
     */
    public function show(Resident $resident): Response
    {
        return $this->render('admin/resident/show.html.twig', [
            'resident' => $resident,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resident_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resident $resident): Response
    {
        $form = $this->createForm(ResidentType::class, $resident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resident_index');
        }

        return $this->render('admin/resident/edit.html.twig', [
            'resident' => $resident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resident_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resident $resident): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resident->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resident);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resident_index');
    }
}
