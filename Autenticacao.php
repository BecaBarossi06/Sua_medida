<?php
include("conexao.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class Autenticacao {
    public function verificarUsuario($email, $senha) {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $usuarios = $result->fetch_assoc();
            if (password_verify($senha, $usuarios['senha'])) {
                return $usuarios;
            }
        }
        return false;  
    }
}
?>
