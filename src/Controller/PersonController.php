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
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class PersonController extends AbstractController
{
    public function form(Request $request, Registry $workflows, $step = 0)
    {
        $session = $request->getSession();
        if ($session === null) {
            $session = new Session();
            $session->start();
        }

        /** @var Person $person */
        $person = $session->get('person', new Person());
        if ($person === null) {
            $person = new Person();
        }

        $form = null;
        $forms = [
            'step1' => ['class' => FirstStepFormType::class, 'data' => $person, 'options' => []],
            'step2' => ['class' => SecondStepFormType::class, 'data' => $person, 'options' => []],
            'step3' => ['class' => ThirdStepFormType::class, 'data' => [], 'options' => []],
        ];

        $personContainer = new PersonContainer($person, $forms);
        $workflow = $workflows->get($personContainer);

        $availablePlaces = ['step1'];
        try {
            $workflow->apply($personContainer, 'to_step2');
            $availablePlaces[] = 'step2';
        } catch (LogicException $e) {
        }

        try {
            $workflow->apply($personContainer, 'to_step3');
            $availablePlaces[] = 'step3';
        } catch (LogicException $e) {
        }
        try {
            $workflow->apply($personContainer, 'to_confirmed');
            $availablePlaces[] = 'confirmed';
        } catch (LogicException $e) {
        }

        if ($step !== 0 && \in_array($step, $availablePlaces)) {
            $personContainer->currentPlace = $step;
        }

        $formDef = isset($forms[$personContainer->currentPlace]) ? $forms[$personContainer->currentPlace] : null;

        if ($formDef) {
            $form = $this->createForm($formDef['class'],$formDef['data'],$formDef['options']);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                if ($form->getData() instanceof Person) {
                    $person = $form->getData();
//                    /** @var Participant $participant */
//                    foreach ($booking->getParticipants() as $participant) {
//                        $participant->setBooking($person);
//                    }
                    $personContainer->person = $person;
                }

            }

            if ($form->isSubmitted() && $form->isValid()) {
                if ($personContainer->currentPlace === 'step3') {
                    $session->set('person', null);
                    return $this->redirectToRoute('completed');
                }

                return $this->redirectToRoute('form');
            }
        }


        $transitions = $workflow->getEnabledTransitions($personContainer);
        $session->set('person', $person);

        return $this->render('person/form.html.twig', [
            'person' => $person,
            'transactions' => $transitions,
            'form' => $form ? $form->createView() : null,
            'personContainer' => $personContainer,
            'availablePlaces' => $availablePlaces,
        ]);

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