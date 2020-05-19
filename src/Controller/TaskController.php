<?php


namespace App\Controller;


use App\Entity\Project;
use App\Entity\Sprint;
use App\Entity\Task;
use App\Form\ProjectType;
use App\Form\TaskFormType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/{project}/backlog", name="backlog")
     */
    public function allTasks(Project $project, ProjectRepository $projectRepository)
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy(['project' => $project->getId()]);

        return $this->render('task/backlog.html.twig',
            [
                'tasks' => $tasks,
                'project' => $project,
                'projects' => $projectRepository->findAll()
            ]
        );
    }

    /**
     * @Route("/{project}/backlog/new", name="backlog_new")
     */
    public function addTask(Project $project, Request $request, ProjectRepository $projectRepository)
    {
        $task = new Task();

        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setProject($project);
            $this->getDoctrine()->getManager()->persist($task);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog', ['project' => $project->getId()]);
        }


        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
            'projects' => $projectRepository->findAll(),
            'project' => $project
        ]);
    }

    /**
     * @Route("/{project}/edit/{task}", name="backlog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project, Task $task, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(TaskFormType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog', ['project' => $project->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
            'project' => $project,
          'projects' => $projectRepository->findAll()
        ]);
    }

    /**
     * @Route("/{project}/delete/{task}", name="task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project, Task $task): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backlog', ['project' => $project->getId()]);
    }

    /**
     * @Route("/{project}/backlog/add-to-sprint/{task}", name="add-to-sprint")
     */
    public function addTasktoSprint(Project $project, Task $task, ProjectRepository $projectRepository)
    {
        $sprints = $this->getDoctrine()->getRepository(Sprint::class)->findBy(['project' => $project]);

        if (!empty($_POST["sprint"])){
            $sprint = $this->getDoctrine()->getRepository(Sprint::class)->findOneBy(['id' => $_POST['sprint']]);
            if (!empty($sprint)){
                $task->setSprint($sprint);
                $this->getDoctrine()->getManager()->persist($task);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render('task/add-to-sprint.html.twig',
            [
                'task' => $task,
                'sprints'=> $sprints,
                'project' =>$project,
              'projects' => $projectRepository->findAll()
            ]
        );
    }
}
