# N8N WP

**N8N WP** é um plugin para WordPress que gera um token seguro e expõe uma rota REST personalizada para integração com o [n8n](https://n8n.io), uma ferramenta poderosa de automação de fluxos de trabalho. Perfeito para criar posts automaticamente, integrar com sistemas externos (como CRMs e ERPs) e acionar processos com dados dinâmicos via API.

## Recursos Principais

- **Geração de Token Seguro**: Crie um Bearer Token diretamente no painel de administração do WordPress para acesso seguro à API.
- **Rota REST Protegida**: Utilize o endpoint `/wp-json/n8n-wp/v1/create-post` protegido por autenticação Bearer Token.
- **Criação de Posts Personalizados**: Crie posts com título, conteúdo, categoria e data personalizada usando JSON estruturado.
- **Compatibilidade Ampla**: Integra-se com n8n e outras ferramentas que suportam JSON e autenticação Bearer Token.
- **Integração com Sistemas Externos**: Conecte o WordPress a CRMs, ERPs ou outros sistemas para fluxos de trabalho automatizados.
- **Gerenciamento Fácil de Tokens**: Renove ou substitua tokens diretamente pelo painel de administração.

## Requisitos

- **WordPress**: 6.7 ou superior
- **PHP**: 7.4 ou superior
- **Testado até**: WordPress 6.8
- **Licença**: GPLv2 ou superior ([detalhes](https://www.gnu.org/licenses/gpl-2.0.html))

## Instalação

1. Faça o upload da pasta `n8n-wp` para o diretório `/wp-content/plugins/`.
2. Ative o plugin pelo menu **Plugins** no WordPress.
3. Acesse o menu **N8N WP** no painel de administração e gere seu token.
4. Configure o token no n8n usando autenticação do tipo Bearer.
5. Utilize o endpoint: `https://seusite.com/wp-json/n8n-wp/v1/create-post`.

## Como Usar

Após a instalação, configure um fluxo no n8n (ou outra ferramenta compatível) para enviar requisições POST ao endpoint fornecido, incluindo o token no cabeçalho `Authorization: Bearer SEU_TOKEN`. O corpo da requisição deve ser um JSON estruturado contendo os dados do post, como título, conteúdo, categoria e data.

Exemplo de requisição:
```json
{
  "title": "Novo Post Automatizado",
  "content": "Conteúdo do post enviado via API.",
  "category": "Notícias",
  "date": "2025-05-28T22:00:00"
}
```

## Perguntas Frequentes

### Posso usar o plugin com outras ferramentas além do n8n?
Sim, qualquer ferramenta que envie dados em formato JSON e suporte autenticação Bearer Token no cabeçalho `Authorization` pode ser usada com o N8N WP.

### Como renovar ou substituir o token?
Acesse o menu **N8N WP** no painel de administração do WordPress e gere um novo token conforme necessário.

## Capturas de Tela

1. **Tela de Geração de Token**: Interface no painel do WordPress para criar e gerenciar tokens.  
   *(Adicione a captura de tela em `screenshots/token-generation.png`.)*
2. **Exemplo de Fluxo no n8n**: Configuração de um fluxo no n8n enviando dados para o WordPress.  
   *(Adicione a captura de tela em `screenshots/n8n-workflow.png`.)*

> **Nota**: Certifique-se de adicionar as capturas de tela na pasta `screenshots/` do repositório e atualizar os caminhos conforme necessário.

## Changelog

### 1.1
- Melhorias na estabilidade e documentação.
- Adicionado suporte para WordPress 6.8.

### 1.0.0
- Versão inicial com suporte à criação de posts via API segura.

## Notas de Atualização

### 1.1
Atualização para compatibilidade com WordPress 6.8 e melhorias na documentação.

### 1.0.0
Versão estável inicial do plugin N8N WP.

## Contribuição

Contribuições são bem-vindas! Por favor, abra uma [issue](https://github.com/rodolfok/n8n-wp/issues) ou envie um [pull request](https://github.com/rodolfok/n8n-wp/pulls) no repositório. Certifique-se de seguir as diretrizes de contribuição (a serem adicionadas em `CONTRIBUTING.md`).

## Licença

Este plugin é um software livre licenciado sob a [GNU General Public License v2 ou superior](https://www.gnu.org/licenses/gpl-2.0.html).

## Créditos

Desenvolvido por [rodolfok](https://github.com/rodolfok).