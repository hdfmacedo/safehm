# SafeHm

Sistema simples em PHP demonstrando cadastro e login.

Agora é possível criar squads/comitês através do menu lateral.

## Como executar

1. Instale um servidor PHP (versão 8+).
2. A partir da pasta do projeto execute:
   ```bash
   php -S localhost:8000
   ```
3. Acesse `http://localhost:8000` no navegador.

As squads são salvas em `data/squads.json`.

Todos os usuários são armazenados em arquivos JSON em `data/users/`. A pasta já existe no repositório, mas os arquivos de dados são ignorados pelo git.
