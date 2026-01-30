<?php

namespace Alura\Armazenamento\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private int $id;
   
    /**
     * @Column(type="text")
     */
    private string $email;

    /**
     * @Column(type="text")
     */
    private string $senha;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getSenhaCifrada()
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = password_hash($senha, PASSWORD_ARGON2ID);
    }

    public function senhaEstaCorreta(string $senhaPura)
    {
        return password_verify($senhaPura, $this->senha);
    }
}
