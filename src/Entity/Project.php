<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project {

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
   * @ORM\OneToMany(targetEntity="App\Entity\Sprint", mappedBy="project")
   */
  private $sprints;

  /**
   * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="projects")
   */
  private $contributor;

  /**
   * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="project")
   */
  private $tasks;

  public function __construct() {
    $this->sprints = new ArrayCollection();
    $this->tasks = new ArrayCollection();
  }

  public function getId(): ?int {
    return $this->id;
  }

  public function getTitle(): ?string {
    return $this->title;
  }

  public function setTitle(string $title): self {
    $this->title = $title;

    return $this;
  }

  public function getResume(): ?string {
    return $this->resume;
  }

  public function setResume(?string $resume): self {
    $this->resume = $resume;

    return $this;
  }

  /**
   * @return Collection|Sprint[]
   */
  public function getSprints(): Collection {
    return $this->sprints;
  }

  public function addSprint(Sprint $sprint): self {
    if (!$this->sprints->contains($sprint)) {
      $this->sprints[] = $sprint;
      $sprint->setProjet($this);
    }

    return $this;
  }

  public function removeSprint(Sprint $sprint): self {
    if ($this->sprints->contains($sprint)) {
      $this->sprints->removeElement($sprint);
      // set the owning side to null (unless already changed)
      if ($sprint->getProjet() === $this) {
        $sprint->setProjet(NULL);
      }
    }

    return $this;
  }

  public function getContributor(): ?User {
    return $this->contributor;
  }

  public function setContributor(?User $contributor): self {
    $this->contributor = $contributor;

    return $this;
  }

  /**
   * @return Collection|Task[]
   */
  public function getTasks(): Collection {
    return $this->tasks;
  }

  public function addTask(Task $task): self {
    if (!$this->tasks->contains($task)) {
      $this->tasks[] = $task;
      $task->setProject($this);
    }

    return $this;
  }

  public function removeTask(Task $task): self {
    if ($this->tasks->contains($task)) {
      $this->tasks->removeElement($task);
      // set the owning side to null (unless already changed)
      if ($task->getProject() === $this) {
        $task->setProject(NULL);
      }
    }

    return $this;
  }
}
