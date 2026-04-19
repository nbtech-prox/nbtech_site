@php
    $project = $project ?? null;

    $normalizeMediaUrl = static function (?string $url): ?string {
        if (! $url) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($url, PHP_URL_PATH);

        if (in_array($host, ['localhost', '127.0.0.1'], true) && $path) {
            return $path;
        }

        return $url;
    };

    $currentCoverUrl = $normalizeMediaUrl($project?->previewCoverUrl());
    $currentOgUrl = $normalizeMediaUrl($project?->previewOgUrl());
    $currentGallery = collect($project?->previewGalleryItems() ?? []);
@endphp

@if ($errors->any())
    <div class="mb-4 rounded-xl border border-rose-300 bg-rose-50 p-3 text-sm text-rose-700">
        <p class="font-semibold">Existem campos por corrigir:</p>
        <ul class="mt-1 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium" for="title">Título</label>
        <input id="title" name="title" required value="{{ old('title', $project?->title) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('title'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('title')]) aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
        @error('title')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="slug">Slug</label>
        <input id="slug" name="slug" required value="{{ old('slug', $project?->slug) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('slug'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('slug')]) aria-invalid="{{ $errors->has('slug') ? 'true' : 'false' }}">
        @error('slug')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="description">Descrição</label>
    <textarea id="description" name="description" rows="5" required @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('description'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('description')]) aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}">{{ old('description', $project?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4 grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium" for="technologies">Tecnologias (separadas por vírgula)</label>
        <input id="technologies" name="technologies" value="{{ old('technologies', is_array($project?->technologies) ? implode(', ', $project?->technologies) : null) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('technologies'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('technologies')]) aria-invalid="{{ $errors->has('technologies') ? 'true' : 'false' }}">
        @error('technologies')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="project_url">URL do projeto</label>
        <input id="project_url" name="project_url" value="{{ old('project_url', $project?->project_url) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('project_url'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('project_url')]) aria-invalid="{{ $errors->has('project_url') ? 'true' : 'false' }}">
        @error('project_url')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="meta_title">Meta title</label>
        <input id="meta_title" name="meta_title" value="{{ old('meta_title', $project?->meta_title) }}" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('meta_title'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('meta_title')]) aria-invalid="{{ $errors->has('meta_title') ? 'true' : 'false' }}">
        @error('meta_title')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="meta_description">Meta description</label>
    <textarea id="meta_description" name="meta_description" rows="3" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('meta_description'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('meta_description')]) aria-invalid="{{ $errors->has('meta_description') ? 'true' : 'false' }}">{{ old('meta_description', $project?->meta_description) }}</textarea>
    @error('meta_description')
        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4 grid gap-4 md:grid-cols-3">
    <div>
        <label class="mb-1 block text-sm font-medium" for="cover_image">Imagem de capa</label>
        <input id="cover_image" type="file" name="cover_image" accept="image/*" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('cover_image'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('cover_image')]) aria-invalid="{{ $errors->has('cover_image') ? 'true' : 'false' }}">
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Se não escolher novo ficheiro, a imagem atual mantém-se.</p>
        @error('cover_image')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        @if ($currentCoverUrl)
            <div class="mt-2 rounded-lg border border-slate-300/70 bg-slate-50 p-2 dark:border-slate-700 dark:bg-slate-900/60">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Imagem atual</p>
                <img src="{{ $currentCoverUrl }}" alt="Imagem de capa atual" class="h-24 w-full rounded-md object-cover">
            </div>
        @endif
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="gallery_images">Galeria</label>
        <input id="gallery_images" type="file" name="gallery_images[]" multiple accept="image/*" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('gallery_images') && !$errors->has('gallery_images.*'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('gallery_images') || $errors->has('gallery_images.*')]) aria-invalid="{{ $errors->has('gallery_images') || $errors->has('gallery_images.*') ? 'true' : 'false' }}">
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Ao enviar novas imagens, a galeria anterior é substituída.</p>
        @error('gallery_images')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        @error('gallery_images.*')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        @if ($currentGallery->isNotEmpty())
            <div class="mt-2 rounded-lg border border-slate-300/70 bg-slate-50 p-2 dark:border-slate-700 dark:bg-slate-900/60">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Galeria atual ({{ $currentGallery->count() }})</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($currentGallery->take(6) as $item)
                        <img src="{{ $normalizeMediaUrl($item['src'] ?? null) }}" alt="{{ $item['alt'] ?? 'Imagem atual da galeria' }}" class="h-16 w-full rounded-md object-cover">
                    @endforeach
                </div>
                @if ($currentGallery->count() > 6)
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">+{{ $currentGallery->count() - 6 }} imagens guardadas.</p>
                @endif
            </div>
        @endif
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="og_image">OpenGraph image</label>
        <input id="og_image" type="file" name="og_image" accept="image/*" @class(['w-full rounded-xl border bg-white px-4 py-2.5 text-sm dark:bg-slate-900', 'border-slate-300 dark:border-slate-700' => !$errors->has('og_image'), 'border-rose-400 ring-2 ring-rose-200 dark:border-rose-500 dark:ring-rose-900/40' => $errors->has('og_image')]) aria-invalid="{{ $errors->has('og_image') ? 'true' : 'false' }}">
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Se não escolher novo ficheiro, a imagem OG atual mantém-se.</p>
        @error('og_image')
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
        @if ($currentOgUrl)
            <div class="mt-2 rounded-lg border border-slate-300/70 bg-slate-50 p-2 dark:border-slate-700 dark:bg-slate-900/60">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Imagem OG atual</p>
                <img src="{{ $currentOgUrl }}" alt="Imagem OpenGraph atual" class="h-24 w-full rounded-md object-cover">
            </div>
        @endif
    </div>
</div>

<div class="mt-4 flex gap-5 text-sm">
    <label class="flex items-center gap-2"><input type="checkbox" name="featured" value="1" @checked(old('featured', $project?->featured))> Destacado</label>
    <label class="flex items-center gap-2"><input type="checkbox" name="published" value="1" @checked(old('published', $project?->published ?? true))> Publicado</label>
</div>
