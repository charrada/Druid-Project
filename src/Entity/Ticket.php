<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\date;
/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creationdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resolverid;

    /**
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $evaluate;

    public function getid(): ?int
    {
        return $this->id;
    }

    public function setid(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getsubject(): ?string
    {
        return $this->subject;
    }

    public function setsubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getcreationdate(): ?string
    {
        return $this->creationdate;
    }

    public function setcreationdate(string $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getresolverid(): ?string
    {
        return $this->resolverid;
    }

    public function setresolverid(string $resolverid): self
    {
        $this->resolverid = $resolverid;

        return $this;
    }

    public function getuserid(): ?int
    {
        return $this->userid;
    }

    public function setuserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getstatus(): ?string
    {
        return $this->status;
    }

    public function setstatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getevaluate(): ?int
    {
        return $this->evaluate;
    }

    public function setevaluate(?int $Evaluate): self
    {
        $this->Evaluate = $Evaluate;

        return $this;
    }
}
