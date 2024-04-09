# LocaVue App

Este é um projeto Laravel-Vue incrível que oferece uma estrutura sólida para criar aplicativos web poderosos. O aplicativo demonstrativo inclui autenticação JWT e um banco de dados pronto para uso. Siga as instruções abaixo para configurar e começar a desenvolver seu próprio aplicativo Laravel-Vue!

## Instruções de Instalação

### 1. Clone o Repositório

```
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Instale as Dependências do Composer

```
composer install
```

### 3. Instale as Dependências do NPM

```
npm install
```

### 4. Gere a Chave de Criptografia do Laravel

```
php artisan key:generate
```

### 5. Gere a Chave JWT Secreta

```
php artisan jwt:secret
```

### 6. Criando o Banco de Dados MySQL

Para utilizar os recursos do aplicativo, é necessário criar um banco de dados MySQL. Siga as instruções abaixo para configurar o banco de dados:

1. **Acesse o MySQL:**

    Abra um terminal ou prompt de comando e acesse o MySQL utilizando as credenciais adequadas, se necessário.

    ```
    mysql -u seu_usuario -p
    ```

2. **Crie o Banco de Dados:**

    Execute o seguinte comando para criar um novo banco de dados. Substitua "carro_locadora" pelo nome desejado para o seu banco de dados.

    ```
    CREATE DATABASE carro_locadora;
    ```

3. **Defina as Credenciais do Banco de Dados:**

    Abra o arquivo `.env` do seu projeto Laravel e ajuste as variáveis de ambiente relacionadas ao banco de dados de acordo com as suas configurações. Aqui está um exemplo:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=carro_locadora
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

    Certifique-se de substituir `seu_usuario` e `sua_senha` pelas suas credenciais do MySQL.

4. **Execute as Migrações do Banco de Dados:**

    Com o banco de dados configurado, você pode executar as migrações para criar as tabelas necessárias no banco de dados. Execute o seguinte comando no terminal:

    ```
    php artisan migrate
    ```

### 6. Execute as Migrações do Banco de Dados

```
php artisan migrate
```

Após seguir essas etapas, o seu banco de dados estará pronto para ser utilizado pelo aplicativo Laravel-Vue. Você pode começar a desenvolver e utilizar os recursos do aplicativo normalmente.

## Executando o Servidor de Desenvolvimento

Para iniciar o servidor de desenvolvimento Laravel, você pode usar o seguinte comando:

```
php artisan serve
```

Para compilar os assets Vue durante o desenvolvimento, você pode usar o comando:

```
npm run watch
```

Isso iniciará o servidor de desenvolvimento e observará todas as alterações nos arquivos Vue para recompilar automaticamente.

## Conclusão

Agora você está pronto para começar a desenvolver seu aplicativo Laravel-Vue! Explore o código-fonte, adicione novos recursos e crie algo incrível. Se precisar de ajuda adicional, consulte a documentação do Laravel e do Vue.js para obter mais informações sobre como construir aplicativos web robustos. Divirta-se codificando!
