<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class PersonController extends AbstractController
{
    public function form(Request $request)
    {
        $session = $request->getSession();
        if ($session === null) {
            $session = new Session();
            $session->start();
        }

        return $this->render('person/form.html.twig', [

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