<?php

use Alura\Armazenamento\Controller;

return [
    '/login' => Controller\FormularioLogin::class,
    '/fazer-login' => Controller\Login::class,
    '/logout' => Controller\Logout::class,
    '/novo-curso' => Controller\FormularioInsercaoCurso::class,
    '/salvar-curso' => Controller\PersistenciaCurso::class,
    '/listar-cursos' => Controller\ListaDeCursos::class,
    '/editar-curso' => Controller\FormularioEdicaoCurso::class,
    '/excluir-curso' => Controller\ExclusaoDeCurso::class,
    '/nova-formacao' => Controller\FormularioInsercaoFormacao::class,
    '/salvar-formacao' => Controller\PersistenciaFormacao::class,
    '/listar-formacoes' => Controller\ListaDeFormacoes::class,
    '/excluir-formacao' => Controller\ExclusaoDeFormacao::class,
];