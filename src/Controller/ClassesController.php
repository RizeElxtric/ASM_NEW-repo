<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassesController extends AbstractController
{
    #[Route('/classes', name: 'classes_detail')]
    public function index(): Response
    {
        return $this->render('classes/detail.html.twig', [
            'controller_name' => 'ClassesController',
        ]);
    }
}
