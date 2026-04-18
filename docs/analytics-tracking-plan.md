# Analytics Tracking Plan

Este ficheiro documenta a base de tracking implementada no frontend público da NBTech.

## Objetivo

- Medir navegação e intenção comercial sem criar event sprawl
- Ligar cliques e submissões a decisões de CRO e conteúdo
- Criar uma base simples para futura integração com GTM, GA4, Plausible ou outro sistema

## Estado Atual

O projeto usa uma abordagem leve com `window.dataLayer` em `resources/js/app.js`.

Atualmente, os eventos são enviados para a `dataLayer`, mas ainda não existe um fornecedor externo configurado no projeto.

## Measurement Readiness

- Score estimado: `78/100`
- Verdict: `Usable with Gaps`

### Forças
- Eventos com naming consistente
- Tracking focado em CTAs e formulários importantes
- Contexto da página incluído

### Gaps
- Ainda não existe destino configurado para recolha dos eventos
- Não há documentação central anterior a este ficheiro
- Não há validação de duplicação por ferramenta externa

## Eventos Implementados

### 1. `page_viewed`

Disparado em `DOMContentLoaded`.

#### Payload
- `event`
- `path`
- `title`

#### Objetivo
- perceber que páginas estão a ser vistas
- servir de base para funis e relatórios por página

## 2. Eventos de clique em CTA

Os CTAs usam atributos `data-analytics-*`.

### Eventos atualmente usados
- `budget_request_clicked`
- `contact_clicked`
- `portfolio_clicked`

#### Payload
- `event`
- `context`
- `label`
- `href`
- `path`

#### Contextos atuais
- `home_hero`
- `home_final_cta`
- `service_detail`

#### Objetivo
- perceber que CTA gera mais intenção
- perceber que contexto da página gera mais cliques

## 3. `form_submitted`

Disparado em qualquer submissão de formulário na interface pública.

#### Payload
- `event`
- `form_action`
- `form_id`
- `path`

#### Objetivo
- medir submissão real de formulários
- distinguir páginas com mais intenção final

## 4. Eventos de intenção em botões de submissão

Atualmente existem estes labels adicionais:
- `contact_submitted_attempt`
- `budget_submitted_attempt`

#### Objetivo
- distinguir intenção declarada por tipo de formulário
- permitir leitura futura de qualidade do lead por fluxo

## Convenções de Naming

Padrão atual:

```text
object_action[_context]
```

Exemplos:
- `page_viewed`
- `budget_request_clicked`
- `contact_clicked`
- `form_submitted`

Regras:
- minúsculas
- underscore
- nomes curtos e sem ambiguidade

## Decisões que estes dados suportam

- Que CTA principal recebe mais cliques
- Se `Contacto` ou `Orçamento` gera mais intenção
- Que páginas de serviço geram mais procura
- Que páginas merecem mais otimização de conversão

## Mapeamento Atual

### Homepage
- CTA orçamento no hero
- CTA contacto geral no hero
- CTA portefólio no hero
- CTA orçamento no bloco final

### Página de contacto
- submissão do formulário de contacto geral

### Página de orçamento
- submissão do formulário de orçamento

### Páginas de serviço
- CTA orçamento
- CTA contacto

## Próximos Passos Recomendados

### Curto prazo
- ligar a `dataLayer` ao GTM ou outra ferramenta
- validar eventos no browser em modo debug

### Médio prazo
- adicionar tracking em:
  - navegação principal
  - cliques em projetos do portefólio
  - envio bem-sucedido por tipo de lead

### Longo prazo
- definir conversões oficiais
- separar eventos de view, intent e completion
- documentar ownership e naming num tracking plan mais completo

## Ficheiros Relevantes

- `resources/js/app.js`
- `resources/views/web/home.blade.php`
- `resources/views/web/contact.blade.php`
- `resources/views/web/budget.blade.php`
- `resources/views/web/services/show.blade.php`

## Done When

- os eventos forem enviados para uma ferramenta real
- houver validação de firing em páginas principais
- as conversões principais estiverem definidas e documentadas
