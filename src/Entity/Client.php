<?php

namespace App\Entity;

use App\Controller\ClientController;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $email = null;

    #[ORM\Column(length: 75)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $username = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([ClientController::APP_CLIENT_INDEX])]
    private ?string $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }
}
