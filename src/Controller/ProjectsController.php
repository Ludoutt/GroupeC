<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    /*
     * @Route("/projects", name="projects")

    public function index(ProjectRepository $projectRepository)
    {
        $projects = $projectRepository->findAll();

        return $this->render('projects/index.html.twig', [
            'projects' => $projects
        ]);
    }*/

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
