<?php


namespace App\Controller;


use App\Entity\Project;
use App\Entity\Sprint;
use App\Entity\Task;
use App\Form\TaskFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/{project}/backlog", name="backlog")
     */
    public function allTasks(Project $project)
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy(['project' => $project->getId()]);

        return $this->render('task/backlog.html.twig',
            [
                'tasks' => $tasks,
                'project' => $project
            ]
        );
    }

    /**
     * @Route("/{project}/backlog/new", name="backlog_new")
     */
    public function addTask(Project $project, Request $request)
    {
        $task = new Task();

        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setProject($project);
            $this->getDoctrine()->getManager()->persist($task);
            $this->getDoctrine()->getManager()->flush();

          return $this->redirectToRoute('backlog', [
            'project' => $project->getId()
          ]);
        }


        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
            'project' => $project
        ]);
    }

    /**
     * @Route("/{project}/backlog/add-to-sprint/{task}", name="add-to-sprint")
     */
    public function addTasktoSprint(Project $project, Task $task)
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
                'project' =>$project
            ]
        );
    }
}
