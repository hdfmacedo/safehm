# SafeHm

Sistema simples em PHP demonstrando cadastro e login.

Agora é possível criar squads/comitês através do menu lateral, escolhendo um emoji para representá-los.
Cada squad recebe uma pasta dentro de `data/squads/` onde ficam suas pautas em arquivos JSON.

## Como executar

1. Instale um servidor PHP (versão 8+).
2. A partir da pasta do projeto execute:
   ```bash
   php -S localhost:8000
   ```
3. Acesse `http://localhost:8000` no navegador.

As squads são salvas em `data/squads.json`.
Cada pasta de squad contém as pautas em `data/squads/<slug>/`. Quando uma squad é
criada, uma pauta inicial chamada "Pauta Principal" é gerada automaticamente.
As pautas são editadas com um editor Markdown que exibe números de linha, e é possível apenas salvar ou salvar e voltar para a página da squad.

Todos os usuários são armazenados em arquivos JSON em `data/users/`. A pasta já existe no repositório, mas os arquivos de dados são ignorados pelo git.
