@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
    <div class="card">
        <h1 class="text-2xl font-bold mb-6">Panel Admin</h1>

        <div class="bg-gray-100 p-4 rounded mb-8">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h2 class="text-lg font-semibold">Admin Access Only</h2>
            </div>
            <p class="text-gray-700">Halaman ini hanya dapat diakses oleh administrator. Berhati-hatilah saat melakukan
                perubahan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-blue-800 mb-1">Total Pengguna</h3>
                        <p class="text-3xl font-bold text-blue-600">127</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="mt-4 text-sm text-blue-600">
                    <span class="font-medium">23 pengguna baru</span> bulan ini
                </div>
            </div>

            <div class="bg-green-50 p-5 rounded-lg border border-green-100">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-green-800 mb-1">Pengguna Premium</h3>
                        <p class="text-3xl font-bold text-green-600">42</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="mt-4 text-sm text-green-600">
                    <span class="font-medium">33%</span> dari total pengguna
                </div>
            </div>

            <div class="bg-purple-50 p-5 rounded-lg border border-purple-100">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-purple-800 mb-1">Total Konversi</h3>
                        <p class="text-3xl font-bold text-purple-600">1,248</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="mt-4 text-sm text-purple-600">
                    <span class="font-medium">156 konversi</span> hari ini
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">Pengguna Terbaru</h3>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-gray-700">Nama</th>
                            <th class="px-4 py-2 text-left text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-gray-700">Role</th>
                            <th class="px-4 py-2 text-left text-gray-700">Tanggal Daftar</th>
                            <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-3">Ahmad Farhan</td>
                            <td class="px-4 py-3">ahmad@example.com</td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">User</span>
                            </td>
                            <td class="px-4 py-3">5 Apr 2023</td>
                            <td class="px-4 py-3">
                                <button class="text-blue-600 hover:underline text-sm">Edit</button>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-3">Budi Santoso</td>
                            <td class="px-4 py-3">budi@example.com</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Premium</span>
                            </td>
                            <td class="px-4 py-3">3 Apr 2023</td>
                            <td class="px-4 py-3">
                                <button class="text-blue-600 hover:underline text-sm">Edit</button>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-3">Citra Dewi</td>
                            <td class="px-4 py-3">citra@example.com</td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">User</span>
                            </td>
                            <td class="px-4 py-3">2 Apr 2023</td>
                            <td class="px-4 py-3">
                                <button class="text-blue-600 hover:underline text-sm">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-right">
                <button class="btn-secondary">Lihat Semua Pengguna</button>
            </div>
        </div>

        <div class="bg-white border rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Tindakan Cepat</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="p-3 border rounded-lg text-left hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Tambah Pengguna Baru</span>
                    </div>
                </button>

                <button class="p-3 border rounded-lg text-left hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Lihat Statistik Konversi</span>
                    </div>
                </button>

                <button class="p-3 border rounded-lg text-left hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Pengaturan Sistem</span>
                    </div>
                </button>

                <button class="p-3 border rounded-lg text-left hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Kelola Konten</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
@endsection
