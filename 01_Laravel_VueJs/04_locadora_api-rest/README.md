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

### 6. Execute as Migrações do Banco de Dados

```
php artisan migrate
```

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
