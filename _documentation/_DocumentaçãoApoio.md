# Comandos para Configurar a Aplicação

Na pasta do projeto correr no terminal os seguintes comandos por order:

**Inicializa o projeto**
>php init

**Atualizar dependencias**
>composer update

**Criar base de dados**
>Criar uma bd chamada `horadapapa`

**Executar as migrações base**
>yii migrate 2

**Criar base de dados**
>Correr o script da bd `horadapapa.sql`

**Popular dados da BD**
>Correr o script da bd `registos.sql`

**Executar as migrações de Rbac**
>php yii migrate --migrationPath=@yii/rbac/migrations
>php yii rbac/init

**Executar Testes**
>php vendor/bin/codecept run -c backend functional LoginCest

# Outras informações

**Testes:**
https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/start-testing.md

Dependências:
- JDK
- Selenium
- Driver do Browser

Correr o Selenium em `standalone`
```bat
"C:\Program Files\Java\jdk-21\bin\java.exe" -jar selenium-server-4.15.0.jar standalone
pause
```

>php vendor/bin/codecept run

>php vendor/bin/codecept run -- -c common

>php vendor/bin/codecept run -- -c frontend

>php vendor/bin/codecept run -- -c frontend acceptance

>php vendor/bin/codecept run -- -c backend


**TESTES APOIO**
>https://www.yiiframework.com/doc/guide/2.0/en/test-overview
> https://codeception.com/docs/UnitTests
> https://codeception.com/docs/FunctionalTests
> https://codeception.com/docs/AcceptanceTests


**GII**
>http://localhost/HoraDaPapa/backend/web/gii

>http://localhost/basic/web/index.php?r=gii

**Exemplos de urls**
>http://localhost/HoraDaPapa/frontend/web/

>http://localhost/HoraDaPapa/backend/web/

>http://localhost/HoraDaPapa/backend/web/api/user/login

**Template FO**

https://htmlcodex.com/bootstrap-restaurant-template/