<?php

use Alura\Armazenamento\Entity\Formacao;
use Behat\Behat\Context\Context;
use Behat\Step\Then;
use Behat\Step\When;

class FormacaoEmMemoria implements Context
{
    private string $mensagemDeErro = '';
    private Formacao $formacao;

    #[When('eu criar uma formação com descrição :arg1')]
    public function euCriarUmaFormaçãoComDescrição($descricaoFormacao): void
    {
        try {
            $this->formacao = new Formacao();
            $this->formacao->setDescricao($descricaoFormacao);
        } catch (\InvalidArgumentException $exception) {
            $this->mensagemDeErro = $exception->getMessage();
        }
    }

    #[Then('eu vou ver a seguinte mensagem de erro :arg1')]
    public function euVouVerASeguinteMensagemDeErro(string $mensagemDeErro): void
    {
        assert($mensagemDeErro === $this->mensagemDeErro);
    }

    #[Then('eu devo ter uma formação criada com a descrição :arg1')]
    public function euDevoTerUmaFormaçãoCriadaComADescrição(string $descricaoFormacao): void
    {
        assert($this->formacao->getDescricao() === $descricaoFormacao);
    }
}
