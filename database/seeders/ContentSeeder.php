<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['title' => 'Websites', 'description' => 'Sites rápidos, modernos e orientados a conversão.', 'icon' => 'globe', 'order' => 1],
            ['title' => 'Web Applications', 'description' => 'Aplicações web escaláveis com arquitetura robusta.', 'icon' => 'app-window', 'order' => 2],
            ['title' => 'Mobile Apps', 'description' => 'Experiências mobile com foco em performance e UX.', 'icon' => 'smartphone', 'order' => 3],
            ['title' => 'E-commerce', 'description' => 'Lojas digitais otimizadas para vendas.', 'icon' => 'shopping-bag', 'order' => 4],
            ['title' => 'Automation', 'description' => 'Automação de processos para reduzir custos operacionais.', 'icon' => 'zap', 'order' => 5],
            ['title' => 'UI / UX Design', 'description' => 'Interfaces elegantes com orientação ao utilizador.', 'icon' => 'palette', 'order' => 6],
        ];

        foreach ($services as $service) {
            Service::query()->firstOrCreate(['title' => $service['title']], $service);
        }

        Testimonial::query()->firstOrCreate(
            ['name' => 'Sofia Martins'],
            [
                'company' => 'FlowRetail',
                'quote' => 'A NBTech transformou a nossa presença digital com rigor técnico e foco em resultados.',
            ],
        );

        Project::query()->firstOrCreate(
            ['slug' => 'plataforma-gestao-retail'],
            [
                'title' => 'Plataforma de Gestão Retail',
                'description' => 'Plataforma para gestão integrada de vendas, inventário e relatórios analíticos.',
                'technologies' => ['Laravel', 'TailwindCSS', 'AlpineJS', 'Redis'],
                'category' => 'Plataforma Digital',
                'featured' => true,
                'published' => true,
                'meta_title' => 'Plataforma de Gestão Retail | NBTech',
                'meta_description' => 'Projeto NBTech para transformação digital do retalho.',
            ],
        );
    }
}
