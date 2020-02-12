<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     */
    public function index()
    {
        return $this->render('projects/index.html.twig', [
            'controller_name' => 'ProjectsController',
        ]);
    }

    /**
     * @Route("/project/{id}", name="show_project")
     * @todo Passer l'entity en paramètres
     */
    public function show_project() {
        return $this->render('projects/show_project.html.twig', [
            'controller_name' => 'ProjectsController',
        ]);
    }
}
