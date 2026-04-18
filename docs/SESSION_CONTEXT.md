# SESSION CONTEXT (NBTech)

Ultima atualizacao: 2026-03-14

## Como retomar rapido
1. Abrir este ficheiro: `docs/SESSION_CONTEXT.md`
2. Dizer: `Continuar a partir do SESSION_CONTEXT`
3. Opcional: indicar prioridade (PDF, admin, frontend, deploy, testes)

## Estado atual resumido
- Projeto Laravel 12 com painel admin funcional e frontend publico ativo.
- Modulo de orcamentos/faturacao e testemunhos com fluxo de moderacao implementados.
- Dashboard admin com foco em testemunhos pendentes.
- README e higiene de repositorio atualizados.

## Ultimos itens concluidos (session-2026-03-08)
- Ajustes de layout e comportamento de PDF em `resources/views/admin/quotes/pdf.blade.php`.
- Tipos de documento: `proforma`, `fatura-recibo`.
- Estados de documento: `draft`, `emitted`, `paid`, `cancelled`.
- Submissao publica de testemunhos + moderacao no admin (`pending`/`approved`).
- Campos finais de testemunhos: `rating` (1-5), `company_url`; avatar removido.

## Proximos passos recomendados
- Revisao visual final mobile-first e ajustes de spacing fino.
- Melhorar feedback de validacao por campo no admin.
- Aumentar cobertura de testes (servicos, testemunhos, permissoes).
- Hardening para VPS (cache, workers Redis, backups).

## Fontes de contexto detalhado
- Sessao detalhada: `docs/session-2026-03-08.md`
- Estado macro do projeto: `docs/ESTADO-PROJETO.md`
- Guia de deploy: `docs/DEPLOYMENT.md`

## Checklist de arranque em nova sessao
- Ler este ficheiro e confirmar a prioridade do dia.
- Verificar estado git (`git status`).
- Validar ambiente local (dependencias, `.env`, BD, Redis).
- Executar teste rapido: `php artisan test`.
