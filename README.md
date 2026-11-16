# Validação Avançada com Form Requests e Regras Customizadas

Este projeto é uma aplicação Laravel (**Projeto Biblioteca**) desenvolvida para demonstrar o isolamento de regras de validação e regras de negócio complexas fora dos Controllers, utilizando **Form Requests** e **Regras Customizadas (Custom Rules)**.

---

## Funcionalidades Demonstradas

- **Isolamento de Validação**: Substituição da validação direta nos Controllers por classes dedicadas de Form Request (`StoreAutorRequest`, `UpdateAutorRequest`, `StoreLivroRequest`, `UpdateLivroRequest`).
- **Injeção de Dependência**: Injeção automática dos Form Requests nas assinaturas dos métodos do Controller (`AutorController` e `LivroController`).
- **Regra Customizada (`NomeCompostoRule`)**: Validação de negócio personalizada criada via Artisan (`php artisan make:rule NomeCompostoRule`) para garantir que o autor cadastrado contenha pelo menos nome e sobrenome.
- **Validação Relacional e de Formatos**: Regras de datas válidas, verificação de chaves estrangeiras (`exists:autores,id`) e mensagens de erro personalizadas.

---

## Requisitos para Execução

Para rodar este projeto em um ambiente local, você precisará de:

- **PHP**: Versão `>= 8.2`
- **Composer**: Versão `>= 2.0`
- **Servidor de Banco de Dados**: MySQL / MariaDB (ou SQLite)
- **Node.js & NPM** (opcional, caso queira compilar os assets com Vite)
