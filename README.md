# SafeHm

Sistema simples em PHP demonstrando cadastro e login.

É possível criar squads/comitês através do menu lateral. Cada squad recebe uma pasta dentro de `data/squads/` onde ficam suas pautas em arquivos JSON.

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
As pautas são editadas com o [Quill](https://quilljs.com/), um editor rich text em modo escuro. É possível apenas salvar ou salvar e voltar para a página da squad.

Todos os usuários são armazenados em arquivos JSON em `data/users/`. A pasta já existe no repositório, mas os arquivos de dados são ignorados pelo git.

O sistema também permite adicionar comentários em cada pauta. Os comentários possuem um status que pode ser configurado em "Configurações > Status de comentários". Por padrão já existem três status: Aberto, Em Andamento e Resolvido.
