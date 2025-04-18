<div>
    @php
        $displayUrl = is_callable($url) ? $url($getRecord()) : $url;
        $displayName = is_callable($name) ? $name($getRecord()) : $name;
    @endphp

    @if (isset($displayUrl) && $displayUrl)
        <div class="flex flex-col items-center">
            <div class="mb-2 rounded overflow-hidden border border-gray-300 dark:border-gray-700 w-full max-w-xl">
                <img src="{{ $displayUrl }}" alt="{{ $displayName ?? 'Preview' }}" class="w-full h-auto" />
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                {{ $displayName ?? 'Gambar' }}
            </div>
            <div class="mt-2">
                <a href="{{ $displayUrl }}" target="_blank"
                    class="text-primary-500 hover:text-primary-600 text-sm font-medium">
                    Lihat Ukuran Penuh
                </a>
            </div>
        </div>
    @else
        <div class="text-center p-4 bg-gray-100 dark:bg-gray-800 rounded">
            <span class="text-gray-500 dark:text-gray-400">Tidak ada gambar</span>
        </div>
    @endif
</div>
