<x-filament::page>

    <x-filament::widgets :widgets="$this->getWidgets()" :columns="$this->getColumns()" />


    <div class="mt-6 p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Selamat Datang di Panel Admin BOAS FAR Convert</h2>
        <p class="mb-3">Panel admin ini memungkinkan Anda untuk mengatur:</p>
        <ul class="list-disc list-inside mb-4 ml-4">
            <li>Pengguna dan hak akses</li>
            <li>Statistik konversi</li>
            <li>Hasil konversi</li>
            <li>Konten website</li>
        </ul>
        <p>Gunakan menu navigasi di sebelah kiri untuk mengakses fitur-fitur yang tersedia.</p>
    </div>
</x-filament::page>
