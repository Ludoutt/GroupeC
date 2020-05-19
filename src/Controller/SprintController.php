<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Sprint;
use App\Form\SprintType;
use App\Repository\ProjectRepository;
use App\Repository\SprintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SprintController extends AbstractController {

  /**
   * @Route("/{id}/sprint/", name="sprint_index", methods={"GET"})
   */
  public function index(Project $project, SprintRepository $sprintRepository, ProjectRepository $projectRepository): Response {
    return $this->render('sprint/index.html.twig', [
      'project' => $project,
      'projects' =>$projectRepository->findAll()
    ]);
  }

  /**
   * @Route("/{id}/sprint/new", name="sprint_new", methods={"GET","POST"})
   */
  public function new(Project $project, Request $request, ProjectRepository $projectRepository): Response {
    $sprint = new Sprint();
    $form = $this->createForm(SprintType::class, $sprint);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $sprint->setProject($project);
      $entityManager->persist($sprint);
      $entityManager->flush();

      return $this->redirectToRoute('sprint_index', ['id' => $project->getId()]);
    }

    return $this->render('sprint/new.html.twig', [
      'sprint' => $sprint,
      'project' => $project,
      'form' => $form->createView(),
      'projects' =>$projectRepository->findAll()
    ]);
  }

  /**
   * @Route("/project/sprint/{id}/edit", name="sprint_edit",
   *   methods={"GET","POST"})
   */
  public function edit(Sprint $sprint, Request $request, ProjectRepository $projectRepository): Response {
    $form = $this->createForm(SprintType::class, $sprint);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('sprint_index', ['id' => $sprint->getProject()->getId()]);
    }

    return $this->render('sprint/edit.html.twig', [
      'sprint' => $sprint,
      'form' => $form->createView(),
      'projects' =>$projectRepository->findAll()
    ]);
  }

  /**
   * @Route("/project/sprint/{id}", name="sprint_delete", methods={"DELETE"})
   */
  public function delete(Project $project, Request $request, Sprint $sprint): Response {
    if ($this->isCsrfTokenValid('delete' . $sprint->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($sprint);
      $entityManager->flush();
    }

    return $this->redirectToRoute('sprint_index', ['id' => $sprint->getProject()->getId()]);
  }

  /**
   * @Route("/project/sprint/{id}", name="sprint_show", methods={"GET"})
   */
  public function show(Sprint $sprint, ProjectRepository $projectRepository): Response {
    return $this->render('sprint/show.html.twig', [
      'sprint' => $sprint,
      'projects' =>$projectRepository->findAll()
    ]);
  }
}
