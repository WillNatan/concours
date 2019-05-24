<?php

namespace App\Controller;

use App\Entity\Concours;
use App\Form\ConcoursType;
use App\Repository\ConcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/concours")
 */
class ConcoursController extends AbstractController
{
    /**
     * @Route("/", name="concours_index", methods={"GET"})
     */
    public function index(ConcoursRepository $concoursRepository): Response
    {
        return $this->render('concours/index.html.twig', [
            'concours' => $concoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="concours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $concour = new Concours();
        $form = $this->createForm(ConcoursType::class, $concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concour->setLink($concour->getName());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concour);
            $entityManager->flush();

            return $this->redirectToRoute('concours_index');
        }

        return $this->render('concours/new.html.twig', [
            'concour' => $concour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{link}", name="concours_show", methods={"GET"})
     */
    public function show(Concours $concour): Response
    {
        return $this->render('concours/show.html.twig', [
            'concour' => $concour,
        ]);
    }

    /**
     * @Route("/{link}/edit", name="concours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Concours $concour): Response
    {
        $form = $this->createForm(ConcoursType::class, $concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concours_index', [
                'id' => $concour->getId(),
            ]);
        }

        return $this->render('concours/edit.html.twig', [
            'concour' => $concour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{link}", name="concours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Concours $concour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($concour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('concours_index');
    }
}
