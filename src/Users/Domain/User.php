<?php

namespace Src\Users\Domain;

class User
{
    private ?int $id;
    private string $username;
    private string $name;
    private ?string $surname;
    private string $email;
    private ?string $password;
    private ?string $hireDate;
    private ?string $department;
    private ?string $position;
    private bool $isAdmin;

    // Extra
    private ?array $applicationIds;

    public function __construct(
        ?int $id,
        string $username,
        string $name,
        ?string $surname,
        string $email,
        ?string $hireDate,
        ?string $department,
        ?string $position,
        bool $isAdmin,
        ?array $applicationIds
    ) {
        $this->id = $id ?? null;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->hireDate = $hireDate;
        $this->department = $department;
        $this->position = $position;
        $this->isAdmin = $isAdmin;
        $this->applicationIds = $applicationIds;
    }

    public static function createWithPassword(
        ?int $id,
        string $username,
        string $name,
        ?string $surname,
        string $email,
        string $password,
        ?string $hireDate,
        ?string $department,
        ?string $position,
        bool $isAdmin,
        ?array $applicationIds
    ) {
        $user = new User($id, $username, $name, $surname, $email, $hireDate, $department, $position, $isAdmin, $applicationIds);
        $user->password = $password;
        return $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getHireDate(): ?string
    {
        return $this->hireDate;
    }

    public function setHireDate(?string $hireDate): void
    {
        $this->hireDate = $hireDate;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): void
    {
        $this->department = $department;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    // Extra
    public function getApplicationIds(): array
    {
        return $this->applicationIds;
    }

    public function setApplicationIds(array $applicationIds): void
    {
        $this->applicationIds = $applicationIds;
    }
}
