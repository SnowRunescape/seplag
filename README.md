# 📘 SEPLAG

Este repositório entrega uma API RESTful completa, segura e performática, desenvolvida sob medida para a proposta da SEPLAG, atendendo todos os requisitos técnicos, funcionais e operacionais solicitados.

### Dados da Inscrição
* Numero da Inscricao: 9585
* BRUNO CAITANO DE ALMEIDA NEVES
* bruno@snowdev.com.br
* ANALISTA DE TI - Desenvolvedor PHP - Senior

## ✅ Tecnologias Utilizadas

- PHP 8.4 + Laravel
- PostgreSQL 17.4 (containerizado)
- MinIO (S3-compatible, containerizado)
- JWT Authentication com expiração e renovação
- Docker & Docker Compose
- Swagger (OpenAPI 3.0)
- Seeders com dados reais de cidades de MT
- Upload seguro com expiração de links
- Padrão PSR e responsabilidade separada por classe
- GitHub Actions para deploy automático

---

## 🔐 Segurança e Boas Práticas

- Autenticação via JWT com expiração de 5 minutos + refresh token
- Acesso protegido via CORS restrito por domínio
- Validações desacopladas (Form Requests) para facilitar manutenção e testes
- Headers pré-configurados para consumo seguro via Postman ou Swagger

---

## 🧪 Recursos Implementados

- CRUD completo para:
  - `ServidorEfetivo`
  - `ServidorTemporario`
  - `Unidade`
  - `Lotacao`

- Endpoints Especiais:
  - Buscar servidores efetivos por `unid_id`
  - Buscar endereço funcional a partir de parte do nome
  - Upload de múltiplas fotos com retorno de link temporário do MinIO

---

## ▶️ Executando o Projeto

```bash
git clone https://github.com/SnowRunescape/seplag.git
cd seplag

docker-compose up -d --build

# Acesse o container e execute as migrations + seed
docker exec -it php-fpm bash
php artisan migrate --seed
```

Acesse `http://localhost:9001` com o usuario `minio` e senha `minio123` e crie um bucket com o nome `meu-bucket`.
## 🧾 Documentação da API

Interface interativa via Swagger:

https://api-project-seplag-br-sp-prod.snowdev.com.br/docs

Interface interativa via Postman:

https://www.postman.com/brunocaiitano/seplag

Coleção Postman incluída com script para salvar o JWT e usar nas próximas requisições
