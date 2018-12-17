<?php

namespace App\Controller;

use App\Entity\PersonContainer;
use App\Form\Person\FirstStepFormType;
use App\Form\Person\SecondStepFormType;
use App\Form\Person\ThirdStepFormType;
use App\Model\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class PersonController extends AbstractController
{
    public function firstStep(Request $request)
    {
        $session = $request->getSession();
        if ($session === null) {
            $session = new Session();
            $session->start();
        }

        $form = $this->createForm(FirstStepFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $this->session->set(CardsTransferFormType::FORM_NAME, $form->getData());
            return $this->redirectToRoute('second_step');
        }
        return $this->render('person/form.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function secondStep(Request $request)
    {

    }


    /**
     * @Route("/completed", name="completed")
     */
    public function completed()
    {
        return $this->render('person/completed.html.twig', [
        ]);
    }

}