# WebForum

Sistema de troca de mensagens entre usuários cadastrados, desenvolvido em PHP para a disciplina de Desenvolvimento de Sistemas Web (Tema 06).

## Tecnologias

PHP, MySQL/MariaDB, HTML e CSS, rodando em XAMPP.

## Como rodar

1. Copie a pasta do projeto para `C:\xampp\htdocs\webforum`.
2. Inicie o Apache e o MySQL no XAMPP.
3. Crie o banco `webforum` no phpMyAdmin e importe o arquivo `resources/database/webforum.sql`.
4. Confira o usuário/senha do banco em `dao/conexao.inc.php` (padrão do XAMPP: usuário `root`, senha vazia).
5. Acesse `http://localhost/webforum/views/index.php`.
