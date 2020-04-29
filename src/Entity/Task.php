<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     *
     * @Assert\Choice({"low", "normal", "high"})
     * @ORM\Column(type="string", length=255)
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sprint", inversedBy="tasks")
     */
    private $sprint;

    /**
     * @Assert\Choice({"todo", "doing", "done"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskTag", inversedBy="tasks")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TaskComment", mappedBy="task")
     */
    private $taskComments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="tasks")
     */
    private $assignee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="tasks")
     * @ORM\Column(nullable=true)
     */
    private $project;

    public function __construct()
    {
        $this->status = 'todo';
        $this->priority = 'normal';
        $this->taskComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getSprint(): ?Sprint
    {
        return $this->sprint;
    }

    public function setSprint(?Sprint $sprint): self
    {
        $this->sprint = $sprint;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTags(): ?TaskTag
    {
        return $this->tags;
    }

    public function setTags(?TaskTag $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return Collection|TaskComment[]
     */
    public function getTaskComments(): Collection
    {
        return $this->taskComments;
    }

    public function addTaskComment(TaskComment $taskComment): self
    {
        if (!$this->taskComments->contains($taskComment)) {
            $this->taskComments[] = $taskComment;
            $taskComment->setTask($this);
        }

        return $this;
    }

    public function removeTaskComment(TaskComment $taskComment): self
    {
        if ($this->taskComments->contains($taskComment)) {
            $this->taskComments->removeElement($taskComment);
            // set the owning side to null (unless already changed)
            if ($taskComment->getTask() === $this) {
                $taskComment->setTask(null);
            }
        }

        return $this;
    }

    public function getAssignee(): ?User
    {
        return $this->assignee;
    }

    public function setAssignee(?User $assignee): self
    {
        $this->assignee = $assignee;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
