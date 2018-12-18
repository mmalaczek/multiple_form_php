<?php

namespace App\Controller;

use App\Form\Person\FirstStepFormType;
use App\Form\Person\SecondStepFormType;
use App\Form\Person\ThirdStepFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function firstStep(Request $request)
    {
        $form = $this->createForm(FirstStepFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('second_step');
        }
        return $this->render('person/_step1.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function secondStep(Request $request)
    {
        $form = $this->createForm(SecondStepFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $this->get('session')->set(SecondStepFormType::FORM_NAME, $form->getData());
            return $this->redirectToRoute('third_step');
        }

        return $this->render('person/_step2.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function thirdStep(Request $request)
    {
        $form = $this->createForm(ThirdStepFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('completed');
        }

        return $this->render('person/_step3.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/completed", name="completed")
     */
    public function completed()
    {
        $data = [];
        $color = '#fff';

        return $this->render('person/completed.html.twig', [
            'data' => $data,
            'color' => $color,
        ]);
    }

}