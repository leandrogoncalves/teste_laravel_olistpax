<h1 align="center">
Projeto de teste para a empresa OlistPax
</h1>

<p align="center">Este projeto foi desenvolvido exclusivamente para suprir os requisitos citados no documento abaixo </p>

[https://drive.google.com/file/d/1fbk-ouS0hj-8IFaumQcIuP_rlMG2RilY/view?usp=sharing](https://drive.google.com/file/d/1fbk-ouS0hj-8IFaumQcIuP_rlMG2RilY/view?usp=sharing)

<p align="center">
  <a href="https://github.com/leandrogoncalves/nestjs_smartranking_api/graphs/contributors">
    <img src="https://img.shields.io/github/contributors/leandrogoncalves/nestjs_smartranking_api?color=%237159c1&logoColor=%237159c1&style=flat" alt="Contributors">
  </a>
  <a href="https://opensource.org/licenses/MIT">
    <img src="https://img.shields.io/github/license/leandrogoncalves/nestjs_smartranking_api?color=%237159c1&logo=mit" alt="License">
  </a>
</p>

<hr>

## Participantes

| [<img src="https://avatars3.githubusercontent.com/u/12039813?s=460&u=78af286aeb7f9d808dc21635e331d0ecdb08e8a7&v=4" width="75px;"/>](https://github.com/leandrogoncalves) |
| :----------------------------------------------------------------------------------------------------------------------------------------------------------------------: |


| [Leandro Gonçalves](https://github.com/leandrogoncalves)

## Requisitos funcionais

- [x] Criação de API de crud de produtos
- [x] Disponilizar um campo "quantity" para incrementar a quantidade do produto na edição do mesmo
- [x] Iniciar banco de dados com os seguintes produtos e quantidade:
   - Sabão em Po = 2
   - Sabão Liquido = 5
- [x] Criação uma tabela de estados do Brasil (id, name, uf), consumir a api (https://servicodados.ibge.gov.br/api/v1/localidades/estados) e salvar os dados na mesma.

## Dependências

- Docker: 20.10.5
- Docker-compose: 1.28.5
- PHP : 7.3.15
- Laravel : 8.16.1
## Configuração inicial

1. Clone o repositório: `git clone git@github.com:leandrogoncalves/php_teste_olistpax.git`
1. Acesse a pasta do projeto: `cd php_teste_olistpax`
1. Execute os containers no Docker: `docker-compose up`
1. Atribua permissão de execução no script de inicialização: `chmod +x ./scripts/startup.sh`
1. Execute o script de inicialização: `./scripts/startup.sh`

## Execução

- Acesse http://localhost:8081

## Documentação da Api

- Acesse http://localhost:8081/api/documentation

## Testes

1. Acesse a pasta do projeto: `cd php_teste_olistpax`
1. Execute no terminal `php artisan test`
