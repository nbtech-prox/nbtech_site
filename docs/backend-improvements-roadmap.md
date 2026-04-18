# Roadmap de Melhoria do Backend

Este documento transforma a análise do backend num plano por fases, para futura implementação progressiva e segura.

## Objetivo

Melhorar consistência arquitetural, reduzir complexidade desnecessária, reforçar segurança e tornar o backend mais simples de manter e evoluir.

## Estado Atual

O backend tem uma base sólida e bem acima da média para um projeto Laravel de pequena/média dimensão. A arquitetura geral existe e está parcialmente bem aplicada:

- controllers relativamente finos em vários fluxos
- requests para validação
- DTOs em alguns casos
- services/actions/repositories em várias áreas
- models relativamente limpos

O maior problema atual não é desorganização total. É **inconsistência entre features** e **excesso de peso em algumas zonas específicas**, sobretudo no fluxo de orçamentos.

## Pontos Fortes

### Estrutura geral
- O projeto segue uma base arquitetural coerente em várias áreas
- Existem separações entre HTTP, validação, transformação de dados e persistência

### Áreas mais bem estruturadas
- Fluxo de projetos com camadas bem definidas:
  - `app/Http/Controllers/Admin/ProjectController.php`
  - `app/DTOs/ProjectData.php`
  - `app/Repositories/ProjectRepository.php`
  - `app/Actions/Project/`

### Proteção do admin
- Rotas admin protegidas com middleware de autenticação e role:
  - `routes/web.php`
  - `app/Http/Middleware/EnsureAdminRole.php`

### Models e seeders
- Models com `fillable` explícito e casts em vários casos
- Seeders idempotentes e úteis para setup local

## Principais Problemas Encontrados

### 1. Inconsistência entre features
- Algumas features seguem bem a arquitetura em camadas
- Outras concentram demasiada lógica diretamente no controller

Exemplo mais crítico:
- `app/Http/Controllers/Admin/QuoteController.php`

### 2. Camadas que existem mas ainda não justificam o seu custo
- Alguns services e actions são demasiado finos e fazem quase só passthrough

Exemplos:
- `app/Actions/Project/CreateProject.php`
- `app/Actions/Project/UpdateProject.php`
- `app/Actions/Project/DeleteProject.php`
- `app/Services/ServiceService.php`
- `app/Services/ContactService.php`

### 3. Lógica demasiado concentrada em Quotes
- criação, atualização, números de documento, transições de estado e PDF estão demasiado centralizados
- isto aumenta risco de bugs e torna o código difícil de evoluir

### 4. Duplicação em requests e controladores
- requests store/update muito parecidos
- repetição de mapeamentos e reconstrução de arrays/itens

### 5. Segurança e robustez ainda abaixo do ideal
- `authorize(): true` em requests admin
- endpoints públicos sem throttle/anti-spam visível
- credenciais admin default em seeder local

### 6. Conteúdo e lógica de apresentação em models
- alguns models carregam conteúdo fallback e estrutura editorial que devia viver noutro sítio

Exemplos:
- `app/Models/Service.php`
- `app/Models/Project.php`

## Prioridade Recomendada

### Prioridade 1 — correções rápidas com impacto alto
- corrigir bug no repositório de testemunhos
- adicionar proteção básica a formulários públicos
- normalizar estados com enum/constantes

### Prioridade 2 — estabilização arquitetural
- extrair lógica pesada de `QuoteController`
- garantir transações e geração segura de números de documento
- remover drift entre schema e camada de escrita

### Prioridade 3 — simplificação e limpeza
- decidir que services/actions devem continuar a existir
- remover camadas que não acrescentam valor real
- tirar conteúdo hardcoded dos models

---

## Fase 1 — Quick Wins e correções de risco imediato

### 1. Corrigir bug de filtros em testemunhos

#### Problema
O repositório de testemunhos usa `orWhere` de forma potencialmente mal agrupada, permitindo resultados incorretos ao combinar pesquisa com estado.

#### Ficheiro principal
- `app/Repositories/TestimonialRepository.php`

#### Objetivo
- garantir que a pesquisa respeita o filtro de estado

#### Verificação
- testes ou confirmação manual no admin com filtros combinados

### 2. Adicionar throttle/anti-spam em endpoints públicos

#### Problema
Formulários públicos aparentam não ter proteção contra abuso.

#### Rotas principais
- `routes/web.php`
  - `/contacto`
  - `/orcamento`
  - `/testemunhos`

#### Objetivo
- reduzir spam e abuso automatizado

#### Possíveis soluções
- middleware `throttle`
- honeypot
- captcha apenas se necessário

#### Verificação
- rotas públicas continuam funcionais
- rate limit aplicado corretamente

### 3. Normalizar valores de estado

#### Problema
Os estados são repetidos como strings em múltiplos pontos do sistema.

#### Exemplos afetados
- `Quote`
- `Testimonial`
- possivelmente outros fluxos administrativos

#### Objetivo
- reduzir erro humano
- simplificar manutenção
- tornar regras mais explícitas

#### Verificação
- uso centralizado de enum ou constantes

---

## Fase 2 — Refactor crítico do fluxo de orçamentos

### 4. Extrair lógica de `QuoteController`

#### Problema
`QuoteController` concentra demasiada responsabilidade.

#### Ficheiro principal
- `app/Http/Controllers/Admin/QuoteController.php`

#### Objetivo
- separar:
  - criação
  - atualização
  - transições de estado
  - geração de número
  - emissão/download
  - persistência de itens

#### Estrutura recomendada
- `Actions` para operações focadas
- `Service` para regras de domínio
- `Repository` para queries/persistência

#### Verificação
- reduzir tamanho e responsabilidade do controller
- manter comportamento atual intacto

### 5. Tornar geração de número segura

#### Problema
Geração de número de orçamento pode sofrer race condition em concorrência.

#### Objetivo
- usar transação e mecanismo seguro de geração/incremento

#### Verificação
- testes para múltiplas criações
- sem colisões em cenários concorrentes simulados

### 6. Evitar mutação de estado em GET

#### Problema
`downloadDocument()` altera estado em rota GET.

#### Objetivo
- separar leitura/download de mutação de estado
- tornar o comportamento previsível

#### Verificação
- downloads continuam funcionais
- estado passa a mudar de forma explícita

---

## Fase 3 — Consistência entre camadas

### 7. Rever services/actions passthrough

#### Problema
Há camadas que existem mas ainda fazem pouco.

#### Exemplos
- `app/Actions/Project/`
- `app/Services/ServiceService.php`
- `app/Services/ContactService.php`

#### Objetivo
- decidir entre:
  - simplificar e remover camadas finas
  - ou consolidar lógica real nelas

#### Critério
- se a camada não encapsula regra ou decisão, pode ser excesso

### 8. Uniformizar estratégia por feature

#### Problema
Cada módulo segue um padrão diferente.

#### Objetivo
- definir padrão claro, por exemplo:
  - CRUD simples: Controller -> Request -> Repository
  - Fluxos de negócio: Controller -> Request -> DTO -> Action/Service -> Repository

#### Verificação
- novos desenvolvimentos seguem decisão consistente

### 9. Remover drift entre DB/model e write path

#### Problema
Há campos existentes no schema/model que ainda não estão totalmente integrados no fluxo administrativo.

#### Exemplo
- SEO em `Service`

#### Objetivo
- garantir que todos os campos relevantes do domínio estão representados de forma coerente nas requests/DTOs/services/admin

---

## Fase 4 — Conteúdo, domínio e manutenção a longo prazo

### 10. Retirar conteúdo hardcoded dos models

#### Problema
Há conteúdo editorial/presentacional embutido em models.

#### Ficheiros principais
- `app/Models/Service.php`
- `app/Models/Project.php`

#### Objetivo
- mover conteúdo para uma camada mais apropriada:
  - config dedicada
  - content repository
  - content tables
  - view model / presenter

#### Benefícios
- menos mistura entre domínio e apresentação
- mudanças de conteúdo sem tocar em lógica de model

### 11. Reforçar policies/autorização por recurso

#### Problema
Middleware de admin resolve o básico, mas falta granularidade.

#### Objetivo
- preparar o sistema para crescer sem acoplamento a `authorize(): true`

#### Verificação
- decisões de acesso passam a estar centralizadas e testáveis

### 12. Rever seeders sensíveis

#### Problema
Seeder de admin com credenciais default pode ser perigoso fora de ambiente controlado.

#### Objetivo
- limitar a execução a local/dev ou tornar isto explicitamente seguro

---

## Checklist Priorizada

### Quick wins
- [ ] Corrigir agrupamento da pesquisa em testemunhos
- [ ] Adicionar throttle aos formulários públicos
- [ ] Centralizar estados com enum/constantes

### Refactors críticos
- [ ] Extrair lógica de `QuoteController`
- [ ] Garantir geração segura de números de orçamento
- [ ] Remover mutação de estado em GET

### Limpeza arquitetural
- [ ] Rever services/actions muito finos
- [ ] Definir padrão arquitetural por tipo de feature
- [ ] Alinhar write path com schema/model

### Longo prazo
- [ ] Tirar conteúdo hardcoded dos models
- [ ] Adicionar policies por recurso
- [ ] Rever seeders sensíveis

## Ordem Recomendada De Implementação

1. Bug do `TestimonialRepository`
2. Throttle/anti-spam dos formulários públicos
3. Enum/constantes de estados
4. Refactor de `QuoteController`
5. Geração segura de números de orçamento
6. Remover mutação de estado em GET
7. Rever camadas passthrough
8. Tirar conteúdo hardcoded dos models
9. Reforçar policies e segurança operacional

## Done When

- [ ] O backend segue padrões mais consistentes entre módulos
- [ ] O fluxo de orçamentos deixa de ser o principal ponto de risco
- [ ] O sistema público está melhor protegido contra abuso
- [ ] O domínio fica menos acoplado a conteúdo e apresentação
- [ ] Novas features podem ser implementadas com menos ambiguidade arquitetural
