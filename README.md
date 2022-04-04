# Teste técnico Drugovich

## Subir containers de aplicação
`docker-compose up -d --force-recreate`

## Instalação de pacotes do projeto
`docker-compose exec web composer install`

## Informações de ambiente
Adicionado conexão ao container de mysql no arquivo .env.example e após copiado ou renomeado para .env, executar o comando:
<br>`docker-compose exec web php artisan key:generate`</br>

# Executar migrations
`docker-compose exec web php artisan migrate:fresh --seed`

## O usuário para login na api

### Usuário com acesso nivel 2
- email: teste@admin.com
- password: admin

### Usuário com acesso nivel 2
- email: admin@admin.com
- password: admin
 
## Executar testes com Pest
`docker-compose exec web php vendor/bin/pest`

## Documentação da api
O arquivo de documentação encontra-se no arquivo Drugovich.yml e está utlizando o formato de openApi v3. Ela também encontra-se disponível através da url: <br>
`https://mic-oliveira.github.io/teste_drugovich/` <br>
Porém como o projeto encontra-se em localhost ele não enviará as respostas de API através do git pages.

## Pipeline
Para pipeline foi utilizado o Actions do github, o arquivo de configuração encontra-se na pasta .github/workflow

## Tratamento de exceção
O tratamento de exceção foi realizado usando o idioma português
