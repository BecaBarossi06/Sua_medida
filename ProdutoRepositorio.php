<?php
include("conexao.php");

class ProdutoRepositorio
{
    private $conn; // Adicione esta linha

    // Construtor para inicializar a conexão
    public function __construct($conn)
    {
        $this->conn = $conn; // Inicializa a conexão
    }

    public function cadastrar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, imagem, preco) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssd",
            $produto->getTipo(),
            $produto->getNome(),
            $produto->getImagemDiretorio(),
            $produto->getPreco()
        );

        // Executa a consulta preparada e verifica o sucesso
        $success = $stmt->execute();

        // Fecha a declaração
        $stmt->close();

        // Retorna um indicador de sucesso
        return $success;
    }

    public function listarDonuts()
    {
        $sql = "SELECT * FROM produtos where tipo = 'Donuts' ORDER BY preco";
        $result = $this->conn->query($sql);

        $produtos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produto = new Produto(
                    $row['id'],
                    $row['tipo'],
                    $row['nome'],
                    $row['preco'],
                    $row['imagem']
                );
                $produtos[] = $produto;
            }
        }

        return $produtos;
    }

    public function atualizarProduto(Produto $produto)
    {
        $imagem = $produto->getImagem();
        if (empty($imagem)) {
            // Prepara a declaração SQL
            $sql = "UPDATE produtos SET tipo = ?, nome = ?, preco = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);

            // Extrai os atributos do objeto Produto
            $tipo = $produto->getTipo();
            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $id = $produto->getId();

            // Vincula os parâmetros
            $stmt->bind_param('ssdi', $tipo, $nome, $preco, $id);
        } else {
            // Prepara a declaração SQL
            $sql = "UPDATE produtos SET tipo = ?, nome = ?, imagem = ?, preco = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            
            // Extrai os atributos do objeto Produto
            $tipo = $produto->getTipo();
            $nome = $produto->getNome();
            $imagem = $produto->getImagemDiretorio();
            $preco = $produto->getPreco();
            $id = $produto->getId();

            // Vincula os parâmetros
            $stmt->bind_param('ssssi', $tipo, $nome, $imagem, $preco, $id);
        }

        // Executa a declaração preparada
        $resultado = $stmt->execute();

        // Fecha a declaração
        $stmt->close();

        return $resultado;
    }

    public function listarDonutsPorId($id)
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Donuts' AND id = ? ORDER BY preco LIMIT 1";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        $produto = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $produto = new Produto(
                $row['id'],
                $row['tipo'],
                $row['nome'],
                $row['preco'],
                $row['imagem']
            );
        }

        // Fecha a declaração
        $stmt->close();

        return $produto;
    }

    public function excluirProdutoPorId($id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id);

        // Executa a consulta preparada
        $success = $stmt->execute();

        // Fecha a declaração
        $stmt->close();

        return $success;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY tipo, preco";
        $result = $this->conn->query($sql);

        $produtos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produto = new Produto(
                    $row['id'],
                    $row['tipo'],
                    $row['nome'],
                    $row['preco'],
                    $row['imagem']
                );
                $produtos[] = $produto;
            }
        }

        return $produtos;
    }
}
?>
