<?php

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Infra\EntitymanagerCreator;
use Behat\Step\Given;
use Behat\Step\Then;
use Behat\Step\When;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private EntityManagerInterface $entityManager;
    private string $mensagemDeErro = '';
    private int $idFormacaoInserida;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    #[When('eu criar uma formação com descrição :arg1')]
    public function euCriarUmaFormaçãoComDescrição($descricaoFormacao): void
    {
        try {
            $formacao = new Formacao();
            $formacao->setDescricao($descricaoFormacao);
        } catch (\InvalidArgumentException $exception) {
            $this->mensagemDeErro = $exception->getMessage();
        }
    }

    #[Then('eu vou ver a seguinte mensagem de erro :arg1')]
    public function euVouVerASeguinteMensagemDeErro(string $mensagemDeErro): void
    {
        assert($mensagemDeErro === $this->mensagemDeErro);
    }

    #[Given('que estou conectado ao banco de dados')]
    public function queEstouConectadoAoBancoDeDados(): void
    {
        $this->entityManager = (new EntitymanagerCreator())->getEntityManager();
    }

    #[When('tento salvar uma formação com a descrição :arg1')]
    public function tentoSalvarUmaFormaçãoComADescrição(string $descricaoFormacao): void
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricaoFormacao);

        $this->entityManager->persist($formacao);
        $this->entityManager->flush();

        $this->idFormacaoInserida = $formacao->getId();
    }

    #[Then('se eu buscar no banco, devo encontrar essa formação')]
    public function seEuBuscarNoBancoDevoEncontrarEssaFormação(): void
    {
        $repositorio = $this->entityManager->getRepository(Formacao::class);
        $formacao = $repositorio->find($this->idFormacaoInserida);

        assert($formacao instanceof Formacao);
    }
}
