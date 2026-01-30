<?php

namespace Alura\Armazenamento\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="formacoes")
 */
class Formacao
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @Column(type="text")
     */
    private string $descricao = '';

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao)
    {
        if (count(explode(' ', $descricao)) < 2) {
            throw new \InvalidArgumentException(
                'Descrição precisa ter pelo menos 2 palavras'
            );
        }
        $this->descricao = $descricao;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
