# Roadmap de Implementacao - Melhorias do Website

Este ficheiro converte as propostas de melhoria em trabalho acionavel para futuros agentes e ciclos de desenvolvimento.

## Objetivo

Melhorar conversao, clareza comercial, SEO, UX e capacidade de medicao do website publico da NBTech, aproveitando a estrutura atual do projeto.

## Ficheiros Atuais Mais Relevantes

### Layout global e navegacao
- `resources/views/layouts/app.blade.php`
- `resources/js/app.js`

### Homepage
- `resources/views/web/home.blade.php`
- `app/Http/Controllers/Web/HomeController.php`
- `app/ViewModels/HomeViewModel.php`

### Contacto e captacao de leads
- `resources/views/web/contact.blade.php`
- `app/Http/Controllers/Web/ContactController.php`
- `app/Services/ContactService.php`
- `app/Http/Requests/StoreContactMessageRequest.php`

### Servicos
- `resources/views/web/services.blade.php`
- `app/Http/Controllers/Web/ServiceController.php`
- `app/Repositories/ServiceRepository.php`

### Portfolio e casos de estudo
- `resources/views/web/portfolio/index.blade.php`
- `resources/views/web/portfolio/show.blade.php`
- `app/Http/Controllers/Web/PortfolioController.php`
- `app/Repositories/ProjectRepository.php`
- `app/Models/Project.php`

### Conteudo SEO e metadata
- `resources/views/layouts/app.blade.php`
- `resources/views/web/home.blade.php`
- `resources/views/web/services.blade.php`
- `resources/views/web/contact.blade.php`
- `resources/views/web/portfolio/show.blade.php`

## Prioridade Geral

### Prioridade 1 - Conversao rapida
- Clareza da homepage
- CTA principal mais forte
- Melhorias na pagina de contacto
- Reforco de prova social

### Prioridade 2 - Estrutura comercial
- Servicos com mensagem mais orientada a problema/solucao
- Portfolio com mais valor comercial
- Melhor distribuicao de CTAs ao longo do site

### Prioridade 3 - SEO e escala
- Páginas mais profundas por servico
- Melhor metadata e estrutura semantica
- Instrumentacao e analytics

---

## Fase 1 - Melhorias de maior impacto e baixa friccao

### 1. Reforcar a proposta de valor na homepage
- Objetivo: tornar a homepage imediatamente mais clara e orientada a conversao
- Ficheiros principais:
  - `resources/views/web/home.blade.php`
  - `app/ViewModels/HomeViewModel.php`
- Melhorias:
  - reescrever o hero para focar em resultado, publico-alvo e diferenciacao
  - tornar a copy menos ampla e mais concreta
  - adicionar uma secao curta “como trabalhamos” ou “o que acontece a seguir”
  - destacar porque escolher a NBTech em vez de apenas listar servicos
- Verificacao:
  - a homepage comunica o valor em menos de 5 segundos
  - existe 1 CTA principal dominante acima da dobra

### 2. Padronizar e reforcar os CTAs principais
- Objetivo: reduzir dispersao e tornar a acao principal consistente
- Ficheiros principais:
  - `resources/views/layouts/app.blade.php`
  - `resources/views/web/home.blade.php`
  - `resources/views/web/services.blade.php`
  - `resources/views/web/portfolio/show.blade.php`
  - `resources/views/web/contact.blade.php`
- Melhorias:
  - escolher um CTA primario consistente, ex.: `Pedir orcamento`
  - rever textos dos botoes para orientacao comercial
  - repetir o CTA nos pontos de decisao
  - considerar CTA sticky no mobile numa fase seguinte
- Verificacao:
  - cada pagina publica tem uma acao principal clara
  - o texto dos botoes e consistente entre paginas

### 3. Melhorar a pagina de contacto
- Objetivo: aumentar submissao de leads
- Ficheiros principais:
  - `resources/views/web/contact.blade.php`
  - `app/Http/Controllers/Web/ContactController.php`
  - `app/Http/Requests/StoreContactMessageRequest.php`
  - `app/Services/ContactService.php`
- Melhorias:
  - reforcar o texto introdutorio com expectativa de resposta
  - adicionar contexto de confianca e proximos passos
  - rever labels, placeholders e microcopy do formulario
  - melhorar estado de sucesso com mensagem mais orientada a conversao
- Verificacao:
  - o formulario continua simples e claro no mobile
  - a mensagem de sucesso confirma rececao e proximo passo

### 4. Tornar a prova social visivel na homepage
- Objetivo: aumentar confianca antes do clique no contacto
- Ficheiros principais:
  - `resources/views/web/home.blade.php`
  - `app/ViewModels/HomeViewModel.php`
  - `app/Repositories/TestimonialRepository.php`
- Melhorias:
  - mostrar testemunhos com mais destaque
  - adicionar logos de clientes se existirem
  - incluir resultados ou descricoes mais especificas quando possivel
- Verificacao:
  - a homepage tem pelo menos uma secao clara de confianca/prova social

---

## Fase 2 - Estrutura comercial mais forte

### 5. Reestruturar a pagina de servicos
- Objetivo: transformar a pagina de servicos em pagina de venda, nao apenas listagem
- Ficheiros principais:
  - `resources/views/web/services.blade.php`
  - `app/Http/Controllers/Web/ServiceController.php`
- Melhorias:
  - reorganizar conteudo por problema, solucao e beneficio
  - adicionar blocos como “ideal para”, “o que inclui” e “resultado esperado”
  - inserir CTA contextual apos cada bloco importante
  - considerar links para futuras paginas individuais de servico
- Verificacao:
  - a pagina explica melhor o valor de cada servico
  - o visitante percebe o proximo passo sem ambiguidades

### 6. Evoluir o portfolio para casos de estudo
- Objetivo: aumentar valor comercial do portfolio
- Ficheiros principais:
  - `resources/views/web/portfolio/index.blade.php`
  - `resources/views/web/portfolio/show.blade.php`
  - `app/Models/Project.php`
- Melhorias:
  - enriquecer a pagina de projeto com estrutura de caso de estudo
  - incluir contexto, desafio, solucao e resultado
  - reforcar CTA apos leitura do projeto
  - melhorar texto do indice de portfolio para filtrar interesse e expectativa
- Verificacao:
  - cada projeto ajuda a vender capacidade, nao apenas a mostrar design

### 7. Melhorar fluxo global de navegacao para conversao
- Objetivo: encaminhar o visitante mais depressa para contacto
- Ficheiros principais:
  - `resources/views/layouts/app.blade.php`
  - `resources/views/web/home.blade.php`
  - `resources/views/web/services.blade.php`
  - `resources/views/web/portfolio/index.blade.php`
- Melhorias:
  - reduzir competicao entre links secundarios e CTA primario
  - reforcar CTA no header e footer
  - adicionar pontos de transicao entre conteudo e contacto
- Verificacao:
  - o caminho para contacto/orcamento fica evidente em todas as paginas principais

---

## Fase 3 - SEO, medicao e escalabilidade

### 8. Melhorar metadata e estrutura SEO
- Objetivo: aumentar capacidade organica do site
- Ficheiros principais:
  - `resources/views/layouts/app.blade.php`
  - `resources/views/web/home.blade.php`
  - `resources/views/web/services.blade.php`
  - `resources/views/web/contact.blade.php`
  - `resources/views/web/portfolio/show.blade.php`
- Melhorias:
  - rever todos os `title` e `meta_description`
  - padronizar melhor o uso de metadata por pagina
  - preparar Open Graph e eventualmente schema markup
  - melhorar heading hierarchy e semantica nas views
- Verificacao:
  - cada pagina publica tem metadata especifica e mais orientada a intencao de pesquisa

### 9. Criar base para paginas individuais de servico
- Objetivo: permitir crescimento SEO e comercial
- Ficheiros provaveis:
  - `routes/web.php`
  - novos templates em `resources/views/web/services/`
  - eventual novo controlador web para detalhe de servico
- Melhorias:
  - criar rotas e templates para servicos individuais
  - estruturar copy por publico, problema, solucao, prova e CTA
- Verificacao:
  - cada servico pode ser promovido e indexado individualmente

### 10. Instrumentar eventos de conversao
- Objetivo: medir comportamento antes de fazer CRO mais agressivo
- Ficheiros principais:
  - `resources/js/app.js`
  - possivel integracao no layout global
- Melhorias:
  - rastrear cliques em CTA
  - medir submissao de formulario
  - medir scroll depth e interacoes relevantes
  - preparar naming consistente para analytics
- Verificacao:
  - eventos principais definidos e prontos para integracao com analytics

---

## Checklist Priorizada

### Quick wins
- [ ] Reescrever hero da homepage
- [ ] Uniformizar CTA principal no site publico
- [ ] Melhorar introducao e microcopy da pagina de contacto
- [ ] Dar mais destaque a prova social na homepage
- [ ] Rever metadata da homepage, servicos e contacto

### Melhorias de impacto medio
- [ ] Reestruturar pagina de servicos com foco comercial
- [ ] Melhorar portfolio index para orientar melhor a leitura
- [ ] Transformar portfolio show em caso de estudo mais rico
- [ ] Reforcar CTA no footer e em pontos de transicao

### Melhorias estruturais
- [ ] Criar paginas individuais por servico
- [ ] Adicionar tracking de eventos principais
- [ ] Preparar schema markup e Open Graph mais ricos
- [ ] Definir base para automacoes e CRM

## Hipoteses De Impacto

### Hipotese 1
- Se a homepage ficar mais clara e especifica, mais visitantes vao clicar no CTA principal

### Hipotese 2
- Se a pagina de contacto explicar melhor o processo e reduzir incerteza, a taxa de submissao aumenta

### Hipotese 3
- Se o portfolio comunicar resultado e contexto, mais visitantes vao confiar na capacidade da NBTech

### Hipotese 4
- Se cada servico tiver uma pagina propria, o site ganha mais capacidade de captar trafego qualificado

## Recomendada Ordem De Execucao

1. Homepage
2. CTA global
3. Contacto
4. Prova social
5. Servicos
6. Portfolio / casos de estudo
7. Metadata SEO
8. Paginas individuais de servico
9. Analytics e tracking

## Done When
- [ ] O site comunica melhor o valor da NBTech
- [ ] Existe uma acao principal clara em cada pagina publica
- [ ] O fluxo de contacto fica mais convincente e com menos friccao
- [ ] O portfolio ajuda a vender, nao apenas a mostrar
- [ ] A base tecnica fica pronta para CRO e SEO continuo
