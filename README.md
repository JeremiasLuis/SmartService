
# Oficina Smart Service

**Oficina Smart Service** é uma aplicação web desenvolvida para gerenciamento completo de oficinas mecânicas, focada em serviços de reparação e manutenção de viaturas. O sistema oferece uma interface intuitiva para administradores, técnicos e clientes, facilitando o controle de serviços, registro de viaturas e usuários, gestão de pagamentos e relatórios. 

Com funcionalidades como o controle de entrada e saída de viaturas, geração de orçamentos, acompanhamento de serviços e um portal de informações, o sistema proporciona eficiência e segurança nas operações da oficina.

## Funcionalidades

### 1. **Registro de Viaturas**
- Permite o cadastro de viaturas, incluindo informações como cor, marca, modelo, tipo, estado e código de validação único.

### 2. **Gestão de Serviços**
- Registro dos principais serviços oferecidos pela oficina, com valores definidos pela instituição.

### 3. **Cadastro de Usuários**
- Gestão de usuários com diferentes níveis de acesso (Administrador, Secretário, Técnico, Cliente e Gerente). Cada nível tem permissões específicas para visualizar ou modificar dados no sistema.

### 4. **Conta Única para Clientes**
- Cada cliente (dono de viatura) possui uma conta única para acessar e monitorar o status de sua viatura.

### 5. **Confirmação de Alterações**
- Para qualquer alteração no estado da viatura ou mudanças no sistema, é necessário confirmar o código de validação gerado aleatoriamente e uma senha.

### 6. **Gestão de Pagamentos**
- Pagamentos dos serviços, incluindo taxas como parque e seguro, são feitos através do sistema. A tabela de preços é configurável pela instituição.

### 7. **Cancelamento de Conta**
- Os clientes têm a opção de cancelar suas contas, conforme os termos estabelecidos no contrato.

### 8. **Portal de Informações**
- O sistema inclui um portal com informações úteis sobre a oficina, serviços, parceiros e localização.

### 9. **Relatórios**
- Geração de relatórios detalhados sobre o status das viaturas, serviços realizados, viaturas atendidas em períodos específicos, entre outros.

### 10. **Código QR para Viaturas Concluídas**
- Ao finalizar o serviço de uma viatura, é gerado um código QR que exibe informações sobre a oficina e a data de saída do veículo.


## Tecnologias Utilizadas

- **Backend & Frontend:** Laravel (PHP)
- **Banco de Dados:** MySQL
- **Notificações:** E-mail via SMTP
- **Autenticação:** Laravel Auth (com suporte para login social)
- **Geração de Código QR:** Pacote `simple-qrcode` para gerar QR codes

---

## Instalação

### 1. Clone o Repositório
Clone este repositório para o seu ambiente local:

```bash
git clone https://github.com/JeremiasLuis/SmartService.git
```

### 2. Instale as Dependências
Navegue até o diretório do projeto e instale as dependências com o Composer:

```bash
cd oficina-smart-service
composer install
```

### 3. Configure o Ambiente
Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente (como credenciais de banco de dados, e-mail, etc.):

```bash
cp .env.example .env
```

Edite o arquivo `.env` conforme necessário, especialmente as configurações do banco de dados e SMTP para envio de e-mails.

### 4. Gere a Chave de Aplicação
Gere a chave de aplicativo Laravel:

```bash
php artisan key:generate
```

### 5. Migre o Banco de Dados
Execute as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
```

### 6. Popule o Banco de Dados (Opcional)
Se desejar, você pode rodar o seeder para popular o banco com dados iniciais:

```bash
php artisan db:seed
```

### 7. Inicie o Servidor
Por fim, inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

### 8. Extraia e execute o arquivo zip sql


Agora, o sistema estará acessível no endereço `http://localhost:8000`.

---

## Contribuição

Sinta-se à vontade para contribuir com melhorias, correções ou novos recursos. Para contribuir:

1. Faça um fork deste repositório.
2. Crie uma nova branch para sua feature (`git checkout -b minha-feature`).
3. Faça as alterações necessárias.
4. Envie um pull request explicando as mudanças.

---

## Licença

Este projeto é licenciado sob a Licença MIT - consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## Contato

Se tiver dúvidas ou sugestões, entre em contato com a equipe de desenvolvimento através do email: jerry.mdigital@gmail.com.



CREATE - Criar
READ - LER
UPDATE - ACTUALIZAR
DELETE - APAGAR

