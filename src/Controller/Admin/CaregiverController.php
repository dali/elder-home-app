<?php

namespace App\Controller\Admin;

use App\Entity\Caregiver;
use App\Form\CaregiverType;
use App\Repository\CaregiverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/caregiver")
 */
class CaregiverController extends AbstractController
{
    /**
     * @Route("/", name="caregiver_index", methods={"GET"})
     */
    public function index(CaregiverRepository $caregiverRepository): Response
    {
        return $this->render('admin/caregiver/index.html.twig', [
            'caregivers' => $caregiverRepository->findCaregivers(),
        ]);
    }

    /**
     * @Route("/new", name="caregiver_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caregiver = new Caregiver();
        $form = $this->createForm(CaregiverType::class, $caregiver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($caregiver);
            $entityManager->flush();

            return $this->redirectToRoute('caregiver_index');
        }

        return $this->render('admin/caregiver/new.html.twig', [
            'caregiver' => $caregiver,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caregiver_show", methods={"GET"})
     */
    public function show(Caregiver $caregiver): Response
    {
        return $this->render('admin/caregiver/show.html.twig', [
            'caregiver' => $caregiver,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caregiver_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caregiver $caregiver): Response
    {
        $form = $this->createForm(CaregiverType::class, $caregiver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caregiver_index');
        }

        return $this->render('admin/caregiver/edit.html.twig', [
            'caregiver' => $caregiver,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caregiver_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caregiver $caregiver): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caregiver->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caregiver);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caregiver_index');
    }
}
