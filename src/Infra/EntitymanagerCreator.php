<?php

namespace Alura\Armazenamento\Infra;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntitymanagerCreator
{
    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        $config = ORMSetup::createAnnotationMetadataConfiguration([__DIR__ . '/../Entity'], true);
        $conexao = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        ]);

        return new EntityManager($conexao, $config);
    }
}
