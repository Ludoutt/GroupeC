<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BacklogsController extends AbstractController {

    /**
     * @Route("/backlogs", name="backlogs")
     */
    public function index() {
        return $this->render('backlogs/index.html.twig', [
                    'controller_name' => 'BacklogsController',
        ]);
    }

    /**
     * @Route("project/{projectId}/backlog/{backlogId}", name="show_backlog")
     * @todo Passer les entity en paramètres
     */
    public function show_backlog() {
        $ticketsNotInASprint = $this->getDoctrine()->getRepository(\App\Entity\Task::class)->findBy(array(
            'sprint' => null
        ));

        $sprints = [];
        return $this->render('backlogs/show_backlog.html.twig', [
                    'ticketsNotInASprint' => $ticketsNotInASprint,
                    'sprints' => $sprints
        ]);
    }

}
