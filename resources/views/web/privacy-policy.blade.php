@extends('layouts.app')

@section('title', 'Política de Privacidade | NBTech')
@section('meta_description', 'Política de Privacidade da NBTech: informação sobre recolha, utilização, conservação e direitos dos titulares de dados pessoais em conformidade com o RGPD e legislação portuguesa aplicável.')

@section('content')
    <section class="container-fluid py-20">
        <div class="mx-auto max-w-4xl" data-reveal>
            <p class="chip-brand">Informação legal</p>
            <h1 class="mt-5 font-display text-4xl leading-[1.02] sm:text-5xl">Política de Privacidade</h1>
            <p class="mt-5 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">
                A presente Política de Privacidade explica como a NBTech trata dados pessoais no contexto do website, pedidos de contacto, pedidos de orçamento e comunicações comerciais ou pré-contratuais.
            </p>
            <p class="mt-3 text-xs uppercase tracking-[0.16em] text-[#697488] dark:text-[#aeb8c9]">Última atualização: 25 de abril de 2026</p>
        </div>

        <div class="mx-auto mt-10 max-w-4xl space-y-6 text-sm leading-7 text-[#3f4858] dark:text-[#dce3ee]" data-reveal>
            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">1. Responsável pelo tratamento</h2>
                <p class="mt-3">
                    A entidade responsável pelo tratamento dos dados pessoais recolhidos através deste website é a NBTech, contactável através da página de contacto disponível em <a href="https://www.nbtech.pt/contacto" class="font-semibold text-brand-600 underline-offset-2 hover:underline">https://www.nbtech.pt/contacto</a>.
                </p>
                <p class="mt-3">
                    Para efeitos desta política, “NBTech”, “nós” ou “nosso” refere-se à entidade que opera este website e presta serviços de desenvolvimento digital, websites, aplicações, plataformas e automação.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">2. Enquadramento legal</h2>
                <p class="mt-3">
                    O tratamento de dados pessoais é realizado em conformidade com o Regulamento (UE) 2016/679, Regulamento Geral sobre a Proteção de Dados (“RGPD”), com a Lei n.º 58/2019, que assegura a execução do RGPD em Portugal, e demais legislação portuguesa e europeia aplicável, incluindo regras relativas a comunicações eletrónicas e cookies quando aplicáveis.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">3. Dados pessoais que podemos recolher</h2>
                <p class="mt-3">Podemos recolher os seguintes dados, consoante a interação realizada:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Nome e apelido ou identificação profissional.</li>
                    <li>Endereço de email.</li>
                    <li>Telefone, quando fornecido voluntariamente.</li>
                    <li>Empresa ou organização.</li>
                    <li>Conteúdo da mensagem enviada através dos formulários.</li>
                    <li>Informação sobre o tipo de projeto, orçamento estimado, prazo pretendido e contexto do pedido.</li>
                    <li>Dados técnicos básicos, como endereço IP, identificadores de sessão, páginas visitadas e informação de dispositivo/navegador, quando necessários para segurança, funcionamento técnico ou análise agregada.</li>
                </ul>
                <p class="mt-4">
                    Não solicitamos categorias especiais de dados pessoais. Pedimos que não incluas dados sensíveis nas mensagens enviadas através dos formulários.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">4. Finalidades do tratamento</h2>
                <p class="mt-3">Os dados pessoais podem ser tratados para:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Responder a pedidos de contacto, esclarecimentos ou propostas.</li>
                    <li>Analisar pedidos de orçamento e preparar respostas comerciais ou pré-contratuais.</li>
                    <li>Gerir comunicações com potenciais clientes, clientes e parceiros.</li>
                    <li>Executar medidas pré-contratuais ou contratuais solicitadas pelo titular dos dados.</li>
                    <li>Cumprir obrigações legais, fiscais, contabilísticas ou administrativas aplicáveis.</li>
                    <li>Garantir a segurança do website, prevenir abuso, spam, fraude ou utilização indevida.</li>
                    <li>Melhorar a experiência do website através de análise técnica ou estatística, preferencialmente de forma agregada ou anonimizada.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">5. Fundamentos de licitude</h2>
                <p class="mt-3">O tratamento pode basear-se nos seguintes fundamentos previstos no RGPD:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li><strong>Execução de diligências pré-contratuais ou contrato:</strong> quando respondes a pedidos de orçamento, propostas ou prestação de serviços.</li>
                    <li><strong>Consentimento:</strong> quando o tratamento dependa de uma autorização livre, específica, informada e explícita.</li>
                    <li><strong>Interesse legítimo:</strong> para segurança do website, prevenção de abuso, gestão normal de contactos profissionais e melhoria dos serviços, desde que não prevaleçam os direitos e liberdades do titular.</li>
                    <li><strong>Cumprimento de obrigação legal:</strong> quando seja necessário conservar ou comunicar dados por imposição legal.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">6. Conservação dos dados</h2>
                <p class="mt-3">
                    Conservamos os dados apenas durante o período necessário para as finalidades que motivaram a recolha, salvo quando exista obrigação legal de conservação por período superior.
                </p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Pedidos de contacto e orçamento: pelo período necessário à gestão do pedido e histórico comercial razoável.</li>
                    <li>Dados associados a contratos, faturação ou obrigações fiscais: durante os prazos legais aplicáveis.</li>
                    <li>Dados técnicos de segurança: pelo período necessário à proteção do website e investigação de incidentes.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">7. Partilha de dados com terceiros</h2>
                <p class="mt-3">
                    Podemos recorrer a prestadores de serviços técnicos, alojamento, email, manutenção, contabilidade, analytics ou ferramentas de produtividade estritamente necessários à operação do website e prestação de serviços.
                </p>
                <p class="mt-3">
                    Estes terceiros apenas devem tratar dados conforme as nossas instruções, para as finalidades contratadas e com medidas adequadas de segurança e confidencialidade. Não vendemos dados pessoais.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">8. Transferências internacionais</h2>
                <p class="mt-3">
                    Caso algum prestador trate dados fora do Espaço Económico Europeu, procuraremos assegurar que existe um mecanismo de transferência válido nos termos do RGPD, como decisão de adequação, cláusulas contratuais-tipo ou outro instrumento legal aplicável.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">9. Cookies e tecnologias semelhantes</h2>
                <p class="mt-3">
                    O website pode usar cookies ou tecnologias semelhantes para funcionamento técnico, segurança, preferências e, quando aplicável, análise estatística. Cookies estritamente necessários podem ser utilizados sem consentimento prévio, na medida em que sejam indispensáveis ao funcionamento do serviço solicitado.
                </p>
                <p class="mt-3">
                    Quando forem usados cookies não essenciais, será solicitado consentimento nos termos da legislação aplicável. Podes configurar o teu navegador para bloquear ou eliminar cookies, embora isso possa afetar algumas funcionalidades. Consulta também a nossa <a href="{{ route('legal.cookies') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">Política de Cookies</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">10. Direitos dos titulares</h2>
                <p class="mt-3">Nos termos do RGPD, podes exercer, quando aplicável, os seguintes direitos:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Direito de acesso aos teus dados pessoais.</li>
                    <li>Direito de retificação de dados inexatos ou incompletos.</li>
                    <li>Direito ao apagamento dos dados.</li>
                    <li>Direito à limitação do tratamento.</li>
                    <li>Direito de oposição ao tratamento.</li>
                    <li>Direito à portabilidade dos dados.</li>
                    <li>Direito de retirar consentimento, quando o tratamento se baseie em consentimento.</li>
                </ul>
                <p class="mt-4">
                    Para exercer estes direitos, contacta-nos através da página de contacto. Poderemos solicitar informação adicional para confirmar a tua identidade antes de responder ao pedido.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">11. Reclamação junto da autoridade de controlo</h2>
                <p class="mt-3">
                    Se considerares que o tratamento dos teus dados pessoais viola a legislação aplicável, podes apresentar reclamação junto da Comissão Nacional de Proteção de Dados (“CNPD”), através de <a href="https://www.cnpd.pt" target="_blank" rel="noopener" class="font-semibold text-brand-600 underline-offset-2 hover:underline">www.cnpd.pt</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">12. Segurança</h2>
                <p class="mt-3">
                    Adotamos medidas técnicas e organizativas adequadas para proteger os dados pessoais contra acesso não autorizado, perda, alteração, divulgação ou destruição indevida. Nenhum sistema é totalmente imune a riscos, mas procuramos aplicar boas práticas proporcionais à natureza dos dados tratados.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">13. Alterações a esta política</h2>
                <p class="mt-3">
                    Podemos atualizar esta Política de Privacidade para refletir alterações legais, técnicas ou operacionais. A versão publicada nesta página é a versão em vigor em cada momento.
                </p>
            </div>
        </div>
    </section>
@endsection
