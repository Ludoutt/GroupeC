<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Sprint;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setTitle('Projet 1');
        $manager->persist($project);

        $project2 = new Project();
        $project2->setTitle('Projet 2');
        $manager->persist($project2);

        $sprint = new Sprint();
        $sprint->setTitle('Sprint 1')
          ->setDateStart(new \DateTime())
          ->setProject($project)
          ->setResume('Test');
        $manager->persist($sprint);

        $task = new Task();
        $task->setTitle('Task 1')
          ->setSprint($sprint);
        $manager->persist($task);

        $task2 = new Task();
        $task2->setTitle('Task 2');
        $manager->persist($task2);

        $manager->flush();
    }
}
