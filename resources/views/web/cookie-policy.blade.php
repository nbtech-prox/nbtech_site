@extends('layouts.app')

@section('title', 'Política de Cookies | NBTech')
@section('meta_description', 'Política de Cookies da NBTech: informação sobre cookies necessários, preferências, análise, gestão de consentimento e configuração no navegador.')

@section('content')
    <section class="container-fluid py-20">
        <div class="mx-auto max-w-4xl" data-reveal>
            <p class="chip-brand">Informação legal</p>
            <h1 class="mt-5 font-display text-4xl leading-[1.02] sm:text-5xl">Política de Cookies</h1>
            <p class="mt-5 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">
                Esta Política de Cookies explica como a NBTech pode utilizar cookies e tecnologias semelhantes no website, para que servem e como podes gerir as tuas preferências.
            </p>
            <p class="mt-3 text-xs uppercase tracking-[0.16em] text-[#697488] dark:text-[#aeb8c9]">Última atualização: 25 de abril de 2026</p>
        </div>

        <div class="mx-auto mt-10 max-w-4xl space-y-6 text-sm leading-7 text-[#3f4858] dark:text-[#dce3ee]" data-reveal>
            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">1. O que são cookies</h2>
                <p class="mt-3">
                    Cookies são pequenos ficheiros guardados no teu dispositivo quando visitas um website. Podem permitir o funcionamento técnico da página, memorizar preferências, proteger sessões, medir utilização de forma agregada ou melhorar a experiência de navegação.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">2. Tipos de cookies que podemos utilizar</h2>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li><strong>Cookies estritamente necessários:</strong> essenciais para o funcionamento do website, segurança, navegação, formulários, sessão e prevenção de abuso. Estes cookies não exigem consentimento prévio quando são indispensáveis ao serviço solicitado.</li>
                    <li><strong>Cookies de preferências:</strong> permitem memorizar opções como idioma, tema visual ou outras preferências de interface.</li>
                    <li><strong>Cookies de análise ou estatística:</strong> ajudam a compreender como o website é utilizado, preferencialmente de forma agregada ou anonimizada, para melhorar conteúdo, desempenho e experiência.</li>
                    <li><strong>Cookies de terceiros:</strong> podem ser definidos por serviços externos integrados no website, como ferramentas de análise, segurança, mapas, vídeo, fontes, formulários ou outros serviços técnicos.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">3. Finalidades</h2>
                <p class="mt-3">Os cookies podem ser utilizados para:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Assegurar o funcionamento técnico do website.</li>
                    <li>Proteger formulários, sessões e áreas restritas contra abuso ou utilização indevida.</li>
                    <li>Guardar preferências de navegação, como o modo claro/escuro.</li>
                    <li>Melhorar desempenho, estrutura de páginas e experiência de utilização.</li>
                    <li>Produzir estatísticas agregadas sobre visitas e interação com o website, quando aplicável.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">4. Consentimento</h2>
                <p class="mt-3">
                    Sempre que sejam usados cookies não essenciais, a NBTech solicitará consentimento prévio, livre, específico, informado e explícito, nos termos da legislação aplicável. O utilizador poderá aceitar, recusar ou alterar preferências quando estiver disponível um mecanismo de gestão de consentimento.
                </p>
                <p class="mt-3">
                    Os cookies estritamente necessários ao funcionamento do website podem ser utilizados sem consentimento prévio, por serem indispensáveis à prestação do serviço solicitado pelo utilizador.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">5. Como gerir ou bloquear cookies</h2>
                <p class="mt-3">
                    Podes configurar o teu navegador para bloquear, apagar ou limitar cookies. A gestão depende do navegador utilizado e pode ser feita nas respetivas definições de privacidade ou segurança.
                </p>
                <p class="mt-3">
                    Bloquear cookies necessários pode afetar funcionalidades essenciais do website, incluindo formulários, sessões, preferências e segurança.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">6. Relação com a Política de Privacidade</h2>
                <p class="mt-3">
                    Quando os cookies ou tecnologias semelhantes envolverem tratamento de dados pessoais, aplica-se também a nossa <a href="{{ route('legal.privacy') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">Política de Privacidade</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">7. Contacto</h2>
                <p class="mt-3">
                    Para questões sobre cookies ou privacidade, contacta-nos através de <a href="https://www.nbtech.pt/contacto" class="font-semibold text-brand-600 underline-offset-2 hover:underline">https://www.nbtech.pt/contacto</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">8. Alterações a esta política</h2>
                <p class="mt-3">
                    Podemos atualizar esta Política de Cookies para refletir alterações legais, técnicas ou operacionais. A versão publicada nesta página é a versão em vigor em cada momento.
                </p>
            </div>
        </div>
    </section>
@endsection
