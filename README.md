# Teste Tecnoponto – Backend

Este repositório contém o Backend da aplicação do teste, desenvolvido para listar e filtrar personagens em cards (integração com API externa) e visualizar logs de auditoria.

## Sobre o Projeto e Decisões Técnicas

O projeto foi feito utilizando **PHP** com o uso do **Laravel 12**. A aplicação consulta uma API externa e trata os dados para a exibição, com a possibilidade de filtrar por nome de personagem. O sistema conta também com um registro de auditoria.

**Decisões Técnicas:**
Utilizei o **SQLite** como banco de dados para facilitar a "correção" do exercício e evitar configurações complexas de ambiente, mas sei que para utilizar o MariaDB basta alterar os campos do `.env`.

Uma implementação que fiz, que não estava explícita no enunciado, foi a criação de um **Service** e um **Controller** específicos para exibir os registros de auditoria. Acredito que isso agregue valor ao código e facilite a visualização dos dados registrados.

**Desafios (Rate Limit):**
Enfrentei um problema de *rate limit* onde a aplicação estava fazendo *n+1* requisições para consultar a dimensão e algumas informações do episódio; foi o maior desafio durante o desenvolvimento.

A solução encontrada foi fazer **Batch Requests** (requisições em lote). Pesquisei para entender o funcionamento e implementei as chamadas agrupadas. Para evitar novos problemas de bloqueio da API, optei pela exibição padrão de **20 personagens** (conforme o retorno nativo da API externa). Sei que, caso fosse necessário exibir tudo, seria possível fazer um "loop" atendendo a condição de que o `info.next` da API externa fosse igual a nulo.

### Utilização da API

Os retornos da aplicação foram padronizados com os nomes em **português**, assim como solicitado no desafio. Portanto, a variável de filtro `nome` deve ser passada em português também.

Exemplo de requisição:
```http
[http://127.0.0.1:8000/api/personagens?nome=Rick](http://127.0.0.1:8000/api/personagens?nome=Rick)```

**Implementações / Melhorias possíveis**

Entendo que existem outras implementações possíveis que poderiam enriquecer o projeto, tais como:

Uso de Cache para otimizar as consultas;
Registrar os logs no próprio sistema de Logs do Laravel;
Utilizar Swagger para documentar as rotas da API;
Efetuar a tradução dinâmica de todos os campos da API.

Optei por seguir estritamente o escopo do projeto e focar na qualidade da entrega atual.

## Como Rodar o Projeto

Siga os passos abaixo para executar a aplicação localmente:

1.  **Clonar o repositório**
    ```bash
    git clone [https://github.com/730s/Teste-Tecnoponto-Backend]
    ```

2.  **Acessar a pasta do projeto**:
    ```bash
    cd Teste-Tecnoponto-Backend
    ```

3.  **Instalar as dependências**:
    Baixar todas as bibliotecas do PHP via Composer.
    ```bash
    composer install
    ```

4.  **Configurar Ambiente e Banco**:
    Cria o arquivo `.env`, gera a chave da aplicação e cria o banco SQLite.
    (Coloquei a RICK_AND_MORTY_BASE_URL no .env example para facilitar na correção do exercício, mas entendo que as rotas de API externas devem ficar fora do ambiente de produção).
    ```bash
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    ```

5.  **Execute o servidor**:
    ```bash
    php artisan serve
    ```

6.  **CONSULTAR A API**:
    A API estará rodando no endereço:
    [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Estrutura de Pastas

- `app/Services/`: Contém a lógica de negócios e integração com APIs externas.
- `app/Http/Controllers/`: Gerencia as requisições da API e respostas JSON.
- `database/`: Local onde ficam as migrations e o arquivo do banco SQLite.
- `routes/api.php`: Definição das rotas e endpoints da aplicação.
