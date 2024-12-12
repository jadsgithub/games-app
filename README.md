# Configuração e Informações do Projeto

Este guia explica como configurar o ambiente local para utilizar a API do projeto **Games App**.

---

## 1. Instalação do Docker
Para executar o projeto, é necessário instalar o Docker. Siga as instruções para o seu sistema operacional:

- **Linux (Ubuntu):** [Guia de Instalação](https://docs.docker.com/engine/install/ubuntu/#installation-methods)
- **Windows:** [Guia de Instalação](https://docs.docker.com/desktop/setup/install/windows-install/)

---

## 2. Clonar o Repositório do Projeto
Abra o terminal e execute o comando abaixo para clonar o repositório do projeto:

```bash
git clone https://github.com/jadsgithub/games-app.git
```

---

## 3. Instalar e Configurar o Projeto
1. Acesse a raiz do projeto pelo terminal:

```bash
cd games-app
```

2. Execute o script de configuração:

```bash
./setup.sh
```

### O que acontece ao executar o script?
- Os containers do projeto serão criados no Docker.
- As dependências do projeto serão instaladas.
- As migrations e seeders serão executados automaticamente.

---

## 4. Acessar a Documentação da API
Após a instalação, você pode acessar a documentação da API no seguinte endereço:

[http://localhost/docs/api#/](http://localhost/docs/api#/)

### Funcionalidades:
A documentação permite testar todos os endpoints da API diretamente, sem necessidade de ferramentas externas, como Insomnia ou Postman.
A documentação possui todas as informações sobre autenticação e exemplos de uso.

---

## 5. Usuários de Teste (Admin e Comum)
Durante a instalação, dois usuários de teste são criados automaticamente:

- **Administrador:**
  - **Email:** `admin@games.com`
  - **Senha:** `admin@2024`

- **Usuário Comum:**
  - **Email:** `user@games.com`
  - **Senha:** `user@2024`

### Criar Outros Usuários
Novos usuários podem ser criados diretamente através dos endpoints na documentação.

---

## 6. Autenticação
Para acessar a API, é necessário autenticar o usuário:

1. Use as credenciais de teste (ou outras que você criar).
2. Acesse o endpoint de login na documentação:
   - **Caminho:** `Authentication -> Performs user login`
   - **Endpoint:** [http://localhost/api/v1/login](http://localhost/api/v1/login)

Após realizar o login, será gerado um token que pode ser usado para acessar os endpoints do projeto.

---

## 7. Gerar Token para Acesso Externo
Depois de autenticado, você pode gerar um token para uso em integrações externas:

1. Acesse o endpoint na documentação:
   - **Caminho:** `Authentication -> Generate external token`
   - **Endpoint:** [http://localhost/api/v1/generate-external-token](http://localhost/api/v1/generate-external-token)

O token gerado permite acesso seguro aos endpoints da API.

---

## 8. Jobs em Segundo Plano
O registro automático de times é realizado via jobs executados em segundo plano. Você pode monitorar os jobs através do Horizon:

- **URL do Horizon:** [http://localhost/horizon/dashboard](http://localhost/horizon/dashboard)

No painel do Horizon, é possível:
- Acompanhar jobs pendentes.
- Identificar e corrigir falhas.

### Executar o Registro Automático de Times
1. Utilize o endpoint na documentação:
   - **Caminho:** `Team -> Automatically register teams`
   - **Endpoint:** [http://localhost/api/v1/teams/register-teams-automatically](http://localhost/api/v1/teams/register-teams-automatically)

---

## 9. Testes
Para executar os testes do projeto:

1. Acesse o container Docker pelo terminal:

```bash
docker exec -it games /bin/bash
```

2. Dentro do container, execute o seguinte comando:

```bash
php artisan test
```

---

Este guia garante uma configuração simples e rápida para começar a utilizar a API do projeto **Games App**.
