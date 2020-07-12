<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdministrarController extends AbstractController
{
    /**
     * @Route("/administrar", name="administrar")
     */
    public function index()
    {
        return $this->render('administrar/index.html.twig', [
            'controller_name' => 'AdministrarController',
        ]);
    }
}
