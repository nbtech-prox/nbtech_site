@extends('layouts.app')

@section('title', 'Termos e Condições | NBTech')
@section('meta_description', 'Termos e Condições de utilização do website e contratação de serviços da NBTech, em conformidade com a legislação portuguesa aplicável.')

@section('content')
    <section class="container-fluid py-20">
        <div class="mx-auto max-w-4xl" data-reveal>
            <p class="chip-brand">Informação legal</p>
            <h1 class="mt-5 font-display text-4xl leading-[1.02] sm:text-5xl">Termos e Condições</h1>
            <p class="mt-5 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">
                Estes Termos e Condições regulam a utilização do website da NBTech e enquadram, de forma geral, os pedidos de contacto, pedidos de orçamento e prestação de serviços digitais, salvo acordo escrito específico em contrário.
            </p>
            <p class="mt-3 text-xs uppercase tracking-[0.16em] text-[#697488] dark:text-[#aeb8c9]">Última atualização: 25 de abril de 2026</p>
        </div>

        <div class="mx-auto mt-10 max-w-4xl space-y-6 text-sm leading-7 text-[#3f4858] dark:text-[#dce3ee]" data-reveal>
            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">1. Identificação e contacto</h2>
                <p class="mt-3">
                    Este website é operado pela NBTech, entidade dedicada à criação de websites, aplicações web, soluções digitais, automação e serviços tecnológicos relacionados.
                </p>
                <p class="mt-3">
                    Para questões relacionadas com estes Termos e Condições, pedidos comerciais ou informação legal, deve ser utilizada a página de contacto disponível em <a href="https://www.nbtech.pt/contacto" class="font-semibold text-brand-600 underline-offset-2 hover:underline">https://www.nbtech.pt/contacto</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">2. Aceitação dos termos</h2>
                <p class="mt-3">
                    Ao aceder ou utilizar este website, o utilizador declara que leu, compreendeu e aceita os presentes Termos e Condições. Caso não concorde com algum ponto, deve abster-se de utilizar o website ou de submeter pedidos através dos formulários.
                </p>
                <p class="mt-3">
                    A utilização do website está ainda sujeita à nossa <a href="{{ route('legal.privacy') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">Política de Privacidade</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">3. Enquadramento legal</h2>
                <p class="mt-3">
                    Estes Termos e Condições são regidos pela lei portuguesa, incluindo, quando aplicável, o Código Civil, o Decreto-Lei n.º 7/2004 relativo ao comércio eletrónico, o Decreto-Lei n.º 24/2014 relativo a contratos celebrados à distância e fora do estabelecimento comercial, a Lei n.º 144/2015 relativa à resolução alternativa de litígios de consumo, bem como demais legislação nacional e europeia aplicável.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">4. Utilização do website</h2>
                <p class="mt-3">O utilizador compromete-se a utilizar o website de forma lícita, responsável e de boa-fé, abstendo-se de:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Submeter informação falsa, abusiva, ofensiva, ilícita ou que viole direitos de terceiros.</li>
                    <li>Tentar aceder indevidamente a áreas restritas, sistemas, servidores ou bases de dados.</li>
                    <li>Introduzir código malicioso, automatismos abusivos, spam ou tráfego destinado a degradar o funcionamento do website.</li>
                    <li>Copiar, reproduzir ou explorar conteúdos do website sem autorização, salvo nos termos permitidos por lei.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">5. Pedidos de contacto e orçamento</h2>
                <p class="mt-3">
                    A submissão de formulários de contacto ou orçamento não constitui, por si só, aceitação de qualquer proposta, celebração de contrato ou obrigação de prestação de serviços.
                </p>
                <p class="mt-3">
                    As respostas enviadas pela NBTech têm natureza informativa, comercial ou pré-contratual. Qualquer contratação dependerá de confirmação expressa, proposta, orçamento, adjudicação, contrato, pagamento inicial ou outro mecanismo acordado entre as partes.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">6. Propostas, preços e pagamentos</h2>
                <p class="mt-3">
                    Os preços, prazos, entregáveis e condições de pagamento são definidos caso a caso em proposta, orçamento, fatura proforma, contrato ou comunicação escrita equivalente.
                </p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Salvo indicação expressa em contrário, valores apresentados podem estar sujeitos a IVA à taxa legal em vigor.</li>
                    <li>O início dos trabalhos pode depender de adjudicação formal, pagamento inicial ou confirmação escrita.</li>
                    <li>Alterações de âmbito, requisitos adicionais ou atrasos causados por falta de informação podem implicar revisão de preço e prazo.</li>
                    <li>Pagamentos em atraso podem suspender a prestação de serviços ou entrega de materiais, sem prejuízo de outros direitos legal ou contratualmente previstos.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">7. Serviços personalizados e direito de livre resolução</h2>
                <p class="mt-3">
                    Quando aplicável a consumidores, o direito de livre resolução previsto na legislação portuguesa poderá ser exercido nos termos legais. Contudo, serviços digitais personalizados, trabalhos iniciados com consentimento do cliente, conteúdos feitos à medida ou serviços plenamente executados podem estar sujeitos a exceções legalmente previstas.
                </p>
                <p class="mt-3">
                    Sempre que aplicável, as condições específicas sobre início dos trabalhos, cancelamento, reembolso ou desistência devem constar da proposta, contrato ou comunicação de adjudicação.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">8. Obrigações do cliente</h2>
                <p class="mt-3">Para boa execução dos serviços, o cliente deve:</p>
                <ul class="mt-4 list-disc space-y-2 pl-5">
                    <li>Fornecer informação verdadeira, completa e atualizada.</li>
                    <li>Garantir que tem direitos ou autorização para usar textos, imagens, marcas, ficheiros e conteúdos fornecidos à NBTech.</li>
                    <li>Responder em tempo razoável a pedidos de validação, feedback ou aprovação.</li>
                    <li>Rever cuidadosamente entregáveis, textos, dados e configurações antes de aprovação final ou publicação.</li>
                    <li>Cumprir prazos de pagamento e demais condições acordadas.</li>
                </ul>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">9. Propriedade intelectual</h2>
                <p class="mt-3">
                    Salvo acordo escrito em contrário, os conteúdos, design, código, componentes, documentação, marcas, logótipos e demais elementos do website da NBTech pertencem à NBTech ou aos respetivos titulares licenciantes.
                </p>
                <p class="mt-3">
                    Nos projetos desenvolvidos para clientes, a titularidade e licença de utilização dos entregáveis finais devem ser reguladas pela proposta ou contrato. Bibliotecas, frameworks, componentes open source, ferramentas de terceiros e metodologias pré-existentes permanecem sujeitos às respetivas licenças e direitos.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">10. Portfólio e referências</h2>
                <p class="mt-3">
                    Salvo acordo de confidencialidade ou instrução escrita em contrário, a NBTech poderá referir publicamente projetos concluídos como parte do seu portfólio, incluindo nome do projeto, descrição geral, tecnologias utilizadas e imagens públicas ou previamente aprovadas.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">11. Garantias e limitações</h2>
                <p class="mt-3">
                    A NBTech procura prestar informação correta e manter o website disponível e seguro. No entanto, não garantimos que o website esteja sempre livre de erros, interrupções, falhas técnicas ou indisponibilidades temporárias.
                </p>
                <p class="mt-3">
                    A informação publicada no website tem caráter geral e não substitui análise técnica, comercial, jurídica, fiscal ou financeira específica. As decisões tomadas com base nesta informação são da responsabilidade do utilizador.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">12. Responsabilidade</h2>
                <p class="mt-3">
                    Na máxima medida permitida por lei, a NBTech não será responsável por danos indiretos, lucros cessantes, perda de dados, perda de negócio, falhas de terceiros, uso indevido do website ou incumprimento de obrigações pelo cliente ou utilizador.
                </p>
                <p class="mt-3">
                    Nada nestes Termos exclui ou limita responsabilidade que não possa ser excluída ou limitada nos termos da lei portuguesa aplicável.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">13. Ligações para terceiros</h2>
                <p class="mt-3">
                    O website pode conter ligações para websites, plataformas ou serviços de terceiros. A NBTech não controla nem se responsabiliza pelo conteúdo, segurança, disponibilidade ou políticas desses terceiros. A utilização desses serviços fica sujeita aos respetivos termos e políticas.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">14. Proteção de dados</h2>
                <p class="mt-3">
                    O tratamento de dados pessoais realizado através do website é descrito na <a href="{{ route('legal.privacy') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">Política de Privacidade</a>, que faz parte integrante destes Termos e Condições.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">15. Resolução alternativa de litígios</h2>
                <p class="mt-3">
                    Em caso de litígio de consumo, o consumidor pode recorrer a uma entidade de resolução alternativa de litígios de consumo competente, nos termos da Lei n.º 144/2015.
                </p>
                <p class="mt-3">
                    Mais informação está disponível no Portal do Consumidor em <a href="https://www.consumidor.gov.pt" target="_blank" rel="noopener" class="font-semibold text-brand-600 underline-offset-2 hover:underline">www.consumidor.gov.pt</a>. Quando aplicável, poderá também ser usado o Livro de Reclamações Eletrónico em <a href="https://www.livroreclamacoes.pt" target="_blank" rel="noopener" class="font-semibold text-brand-600 underline-offset-2 hover:underline">www.livroreclamacoes.pt</a>.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">16. Alterações aos termos</h2>
                <p class="mt-3">
                    Podemos atualizar estes Termos e Condições a qualquer momento para refletir alterações legais, técnicas, comerciais ou operacionais. A versão publicada nesta página é a versão aplicável em cada momento.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <h2 class="text-xl font-semibold text-[#0a0e15] dark:text-white">17. Lei aplicável e foro</h2>
                <p class="mt-3">
                    Estes Termos e Condições são regidos pela lei portuguesa. Sem prejuízo de normas imperativas aplicáveis a consumidores, qualquer litígio será submetido aos tribunais portugueses competentes.
                </p>
            </div>
        </div>
    </section>
@endsection
