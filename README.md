# WebForum

## Funcionalidades

* Página pública com informações sobre o WebForum.
* Cadastro de usuários.
* Login com e-mail e senha.
* Área restrita protegida por sessão.
* Envio de mensagens para usuários cadastrados.
* Listagem de mensagens recebidas.
* Visualização completa da mensagem.
* Remoção de mensagens recebidas.
* Design feito com CSS separado por arquivos.

## Tecnologias utilizadas

* PHP
* MySQL/MariaDB
* Apache
* XAMPP
* HTML
* CSS


## Como rodar o projeto

### 1. Instalar o XAMPP

Para executar o projeto, é necessário ter o XAMPP instalado na máquina.

O XAMPP será usado para iniciar:

* Apache
* MySQL/MariaDB

### 2. Copiar o projeto para a pasta do XAMPP

Copie a pasta do projeto `webforum` para dentro da pasta `htdocs`.

Exemplo no Windows:

```txt
C:\xampp\htdocs\webforum
```

A estrutura deve ficar parecida com:

```txt
C:\xampp\htdocs\webforum\views
C:\xampp\htdocs\webforum\dao
C:\xampp\htdocs\webforum\classes
C:\xampp\htdocs\webforum\controlers
C:\xampp\htdocs\webforum\utils
C:\xampp\htdocs\webforum\resources
```

### 3. Iniciar Apache e MySQL

Abra o painel do XAMPP e clique em **Start** nos serviços:

```txt
Apache
MySQL
```

Os dois serviços precisam ficar ativos.

### 4. Criar o banco de dados

Acesse o phpMyAdmin pelo navegador:

```txt
http://localhost/phpmyadmin
```

Depois clique em **Novo** e crie um banco com o nome:

```txt
webforum
```

### 5. Importar o banco de dados

Com o banco `webforum` selecionado no phpMyAdmin:

1. Clique na aba **Importar**.
2. Clique em **Escolher arquivo**.
3. Selecione o arquivo SQL localizado em:

```txt
resources/database/webforum.sql
```

4. Clique em **Executar**.

Após a importação, o banco deve conter as tabelas necessárias para o sistema, como:

```txt
usuarios
mensagens
```

### 6. Configurar a conexão com o banco

Abra o arquivo:

```txt
dao/conexao.inc.php
```

Confira se os dados de conexão estão corretos.

Exemplo de configuração padrão para XAMPP:

```php
<?php

class Conexao
{
    private $host = "localhost";
    private $dbname = "webforum";
    private $usuario = "root";
    private $senha = "";

    public function getConexao()
    {
        try {
            $con = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->usuario,
                $this->senha
            );

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco: " . $e->getMessage());
        }
    }
}
```

No XAMPP, normalmente o usuário padrão é:

```txt
root
```

E a senha fica vazia:

```txt
""
```

### 7. Acessar o projeto no navegador

Depois de importar o banco e configurar a conexão, acesse:

```txt
http://localhost/webforum/views/index.php
```

## Como testar o sistema

### Cadastro

1. Acesse a página inicial.
2. Clique em **Criar conta**.
3. Cadastre um usuário com nome, e-mail e senha.

### Login

1. Acesse a tela de login.
2. Informe o e-mail e a senha cadastrados.
3. Após o login, o usuário será redirecionado para a área restrita.

### Envio de mensagens

Para testar corretamente, cadastre pelo menos dois usuários.

1. Faça login com o primeiro usuário.
2. Clique em **Enviar mensagem**.
3. Escolha outro usuário como destinatário.
4. Informe o assunto e o conteúdo da mensagem.
5. Envie a mensagem.

### Visualizar mensagens recebidas

1. Faça logout do primeiro usuário.
2. Faça login com o segundo usuário.
3. Acesse **Mensagens recebidas**.
4. Clique em **Visualizar** para ler a mensagem completa.

### Remover mensagens

Na tela de mensagens recebidas, clique em **Remover** para apagar uma mensagem.

## Observações importantes

* As páginas da área restrita são protegidas por sessão.
* O usuário precisa estar logado para enviar, visualizar ou remover mensagens.
* O banco de dados deve ser importado antes de acessar o sistema.
* O arquivo SQL do banco está localizado em:

```txt
resources/database/webforum.sql
```

* Caso o nome do banco seja alterado, também será necessário alterar o valor de `$dbname` no arquivo:

```txt
dao/conexao.inc.php
```

## Problemas comuns

### Erro de conexão com o banco

Verifique se:

* O MySQL está iniciado no XAMPP.
* O banco `webforum` foi criado.
* O arquivo SQL foi importado corretamente.
* O arquivo `dao/conexao.inc.php` está com usuário, senha e nome do banco corretos.

### Página não encontrada

Verifique se o projeto está dentro da pasta:

```txt
C:\xampp\htdocs
```

E acesse pelo navegador usando:

```txt
http://localhost/webforum/views/index.php
```

### CSS não carregando

Verifique se a pasta `css` está dentro de `views`:

```txt
views/css
```

E se o arquivo `cabecalho.inc.php` está carregando os arquivos CSS corretamente.

