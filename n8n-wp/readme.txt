=== N8N WP ===
Contributors:      rodolfok
Tags:              rest-api, automation, webhook, n8n, integration
Requires at least: 6.7
Tested up to: 6.8
Requires PHP:      7.4
Stable tag:        1.1
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Gera um token e cria uma API segura para integração com o n8n.

== Description ==

**N8N WP** permite gerar um token seguro e expõe uma rota REST personalizada para integração com o [n8n](https://n8n.io), a poderosa ferramenta de automação.

Ideal para publicar posts automaticamente, integrar sistemas externos (como CRMs e ERPs) e acionar processos com dados dinâmicos via API.

### Recursos principais:

- Interface no painel do WordPress para gerar o token de autenticação
- Rota protegida por Bearer Token
- Criação de posts com título, conteúdo, categoria e data personalizada
- Totalmente compatível com JSON estruturado vindo do n8n

== Installation ==

1. Faça o upload da pasta `N8N WP` para o diretório `/wp-content/plugins/`
2. Ative o plugin no menu **Plugins** do WordPress
3. Acesse o menu `N8N WP` no admin e gere seu token
4. Configure o token no n8n usando a autenticação do tipo Bearer
5. Use o endpoint: `https://seusite.com/wp-json/N8N WP/v1/create-post`

== Frequently Asked Questions ==

= Posso usar esse plugin com outras ferramentas além do n8n? =
Sim, desde que envie os dados corretamente no formato JSON e use o token no cabeçalho `Authorization: Bearer`.

= Como renovar ou trocar o token? =
Basta acessar o menu do plugin no admin e gerar um novo token.

== Screenshots ==

1. Tela de geração do token
2. Exemplo de fluxo no n8n enviando para o WordPress

== Changelog ==

= 1.0.0 =
* Versão inicial com suporte à criação de posts via API segura.

== Upgrade Notice ==

= 1.0.0 =
Versão estável inicial do plugin N8N WP.

== License ==

Este plugin é software livre e está licenciado sob os termos da GNU General Public License v2 ou superior.

