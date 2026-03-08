<div class="flex items-center gap-1 rounded-lg border border-[#9ea9bc] p-1 dark:border-[#4e576a] dark:bg-[#212631]">
    <button type="button" class="rounded-md px-2 py-1 text-xs" @click="setTheme('light')" :class="mode === 'light' ? 'bg-[#e0e4eb] text-[#0a0e15] dark:bg-[#373f4e] dark:text-white' : 'text-[#4e576a] dark:text-[#e0e4eb]'">Claro</button>
    <button type="button" class="rounded-md px-2 py-1 text-xs" @click="setTheme('dark')" :class="mode === 'dark' ? 'bg-[#e0e4eb] text-[#0a0e15] dark:bg-[#373f4e] dark:text-white' : 'text-[#4e576a] dark:text-[#e0e4eb]'">Escuro</button>
</div>
