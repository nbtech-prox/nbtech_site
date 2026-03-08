@php($project = $project ?? null)

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium" for="title">Título</label>
        <input id="title" name="title" required value="{{ old('title', $project?->title) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="slug">Slug</label>
        <input id="slug" name="slug" required value="{{ old('slug', $project?->slug) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="description">Descrição</label>
    <textarea id="description" name="description" rows="5" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">{{ old('description', $project?->description) }}</textarea>
</div>

<div class="mt-4 grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium" for="technologies">Tecnologias (separadas por vírgula)</label>
        <input id="technologies" name="technologies" value="{{ old('technologies', is_array($project?->technologies) ? implode(', ', $project?->technologies) : null) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="project_url">URL do projeto</label>
        <input id="project_url" name="project_url" value="{{ old('project_url', $project?->project_url) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="category">Categoria</label>
        <input id="category" name="category" required value="{{ old('category', $project?->category) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="meta_title">Meta title</label>
        <input id="meta_title" name="meta_title" value="{{ old('meta_title', $project?->meta_title) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
</div>

<div class="mt-4">
    <label class="mb-1 block text-sm font-medium" for="meta_description">Meta description</label>
    <textarea id="meta_description" name="meta_description" rows="3" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">{{ old('meta_description', $project?->meta_description) }}</textarea>
</div>

<div class="mt-4 grid gap-4 md:grid-cols-3">
    <div>
        <label class="mb-1 block text-sm font-medium" for="cover_image">Imagem de capa</label>
        <input id="cover_image" type="file" name="cover_image" accept="image/*" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="gallery_images">Galeria</label>
        <input id="gallery_images" type="file" name="gallery_images[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium" for="og_image">OpenGraph image</label>
        <input id="og_image" type="file" name="og_image" accept="image/*" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm dark:border-slate-700 dark:bg-slate-900">
    </div>
</div>

<div class="mt-4 flex gap-5 text-sm">
    <label class="flex items-center gap-2"><input type="checkbox" name="featured" value="1" @checked(old('featured', $project?->featured))> Destacado</label>
    <label class="flex items-center gap-2"><input type="checkbox" name="published" value="1" @checked(old('published', $project?->published ?? true))> Publicado</label>
</div>

@if ($errors->any())
    <div class="mt-4 rounded-xl border border-rose-300 bg-rose-50 p-3 text-sm text-rose-700">
        {{ $errors->first() }}
    </div>
@endif
