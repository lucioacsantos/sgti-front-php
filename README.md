# sgti-front-php

## Descrição
Este é o frontend em PHP para o sistema SGTI (Sistema de Gestão de TI). O projeto fornece uma interface web para gerenciamento de ativos, relacionamentos, ambientes, aplicações e outros componentes de infraestrutura de TI, com autenticação robusta incluindo suporte a 2FA (Two-Factor Authentication).

## Funcionalidades
- **Autenticação de Usuários**: Login com suporte a LDAP e autenticação local
- **Autenticação de Dois Fatores (2FA)**: Usando TOTP (Time-based One-Time Password) e códigos de backup
- **Gerenciamento de Ativos**: CRUD para ativos de TI
- **Relacionamentos**: Gerenciamento de relacionamentos entre componentes
- **Ambientes**: Controle de ambientes de desenvolvimento, homologação e produção
- **Aplicações**: Gerenciamento de aplicações e seus metadados
- **Hosts**: Controle de servidores e hosts
- **Criticidades e Status**: Classificação e monitoramento de status
- **Auditoria**: Logs de auditoria para rastreamento de mudanças

## Tecnologias Utilizadas
- **PHP**: Linguagem principal do backend
- **PostgreSQL**: Banco de dados
- **LDAP**: Para autenticação integrada
- **Google Authenticator**: Para geração de códigos TOTP
- **HTML/CSS/JavaScript**: Para a interface web
- **Composer**: Gerenciamento de dependências PHP (se aplicável)

## Estrutura do Projeto
```
sgti-front-php/
├── auth/                    # Classes de autenticação
│   └── Auth.php
├── config/                  # Configurações do sistema
│   └── config.php
├── src/                     # Código fonte principal
│   ├── auth/                # Serviços de autenticação
│   │   ├── AuthService.php
│   │   ├── BackupCodeService.php
│   │   ├── LdapAuth.php
│   │   ├── Totp.php
│   │   └── UserService.php
│   ├── dao/                 # Data Access Objects
│   │   ├── AtivoDAO.php
│   │   ├── AuditDAO.php
│   │   ├── BaseDAO.php
│   │   ├── ConfigDAO.php
│   │   ├── DominioDAO.php
│   │   └── RelacionamentoDAO.php
│   ├── db/                  # Conexão com banco de dados
│   │   └── Database.php
│   └── lib/                 # Bibliotecas externas
│       └── GoogleAuthenticator.php
├── views/                   # Templates/views
│   ├── ambientes.php
│   ├── aplicacoes.php
│   ├── criticidades.php
│   ├── hosts.php
│   ├── relacionamentos.php
│   ├── statuses.php
│   └── tipos.php
├── confirm_2fa.php          # Confirmação de 2FA
├── index.php                # Página inicial
├── login.php                # Página de login
├── logout.php               # Logout
├── main.php                 # Página principal
├── setup_2fa.php            # Configuração de 2FA
└── verify_2fa.php           # Verificação de 2FA
```

## Instalação e Configuração

### Pré-requisitos
- Servidor web (Apache/Nginx) com suporte a PHP 7.4+
- PostgreSQL
- PHP extensions: pgsql, ldap (opcional), mbstring
- Composer (para gerenciamento de dependências)

### Passos de Instalação
1. **Clone o repositório**:
   ```bash
   git clone <url-do-repositorio>
   cd sgti-front-php
   ```

2. **Configure o banco de dados**:
   - Crie um banco de dados PostgreSQL
   - Execute os scripts SQL para criar as tabelas (localizados em `config/` ou fornecido separadamente)

3. **Configure as credenciais**:
   - Edite `config/config.php` com as configurações do banco de dados e LDAP (se aplicável)

4. **Instale dependências** (se houver):
   ```bash
   composer install
   ```

5. **Configure o servidor web**:
   - Configure o DocumentRoot para apontar para a pasta do projeto
   - Certifique-se de que o PHP tem permissões adequadas para escrever nos diretórios necessários

6. **Acesse a aplicação**:
   - Abra o navegador e acesse `http://localhost` (ou a URL configurada)

## Uso
1. **Login**: Acesse a página de login e entre com suas credenciais
2. **Configuração 2FA**: Se for a primeira vez, configure o 2FA seguindo as instruções
3. **Navegação**: Use o menu principal para acessar diferentes seções (ativos, relacionamentos, etc.)
4. **Gerenciamento**: Adicione, edite ou remova registros conforme necessário

## Desenvolvimento
- Para contribuir, faça um fork do projeto e envie pull requests
- Siga os padrões de código PHP PSR-12
- Execute testes antes de submeter mudanças

## Licença
Este projeto está licenciado sob a GNU GPL v3 (LICENSE).

## Contato
Para dúvidas ou suporte, entre em contato com a equipe de desenvolvimento.
