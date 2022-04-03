#Teste técnico Drugovich

##Subir containers de aplicação
`docker-compose up -d --force-recreate`

##Instalação de pacotes do projeto
`docker-compose exec web composer install`

##Informações de ambiente
Adicionado conexão ao container de mysql no arquivo .env.example e após copiado ou renomeado para .env, executar o comando:
<br>`docker-compose exec web php artisan key:generate`</br>

#Executar migrations
`docker-compose exec web php artisan migrate:fresh --seed`

##Executar testes com Pest
`docker-compose exec web php vendor/bin/pest`

##Documentação da api
O arquivo de documentação encontra-se no arquivo Drugovich.yml e está utlizando o formato de openApi v3 

##Pipeline
Para pipeline foi utilizado o Actions do github, o arquivo de configuração encontra-se na pasta .github/workflow

##Tratamento de exceção
O tratamento de exceção foi realizado usando o idioma português
