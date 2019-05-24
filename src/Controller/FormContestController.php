<?php

namespace App\Controller;

use App\Entity\FormContest;
use App\Form\FormContestType;
use App\Repository\FormContestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participation")
 */
class FormContestController extends AbstractController
{
    /**
     * @Route("/", name="form_contest_index", methods={"GET"})
     */
    public function index(FormContestRepository $formContestRepository): Response
    {
        return $this->render('form_contest/index.html.twig', [
            'form_contests' => $formContestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{concours}", name="form_contest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formContest = new FormContest();
        $form = $this->createForm(FormContestType::class, $formContest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formContest);
            $entityManager->flush();

            return $this->redirectToRoute('form_contest_index');
        }

        return $this->render('form_contest/new.html.twig', [
            'form_contest' => $formContest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_contest_show", methods={"GET"})
     */
    public function show(FormContest $formContest): Response
    {
        return $this->render('form_contest/show.html.twig', [
            'form_contest' => $formContest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="form_contest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormContest $formContest): Response
    {
        $form = $this->createForm(FormContestType::class, $formContest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_contest_index', [
                'id' => $formContest->getId(),
            ]);
        }

        return $this->render('form_contest/edit.html.twig', [
            'form_contest' => $formContest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_contest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormContest $formContest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formContest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formContest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_contest_index');
    }
}
