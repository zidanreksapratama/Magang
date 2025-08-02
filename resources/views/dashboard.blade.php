<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat datang, {{ $company->name }}</h2>
            <p class="text-gray-500">Kelola tenant Anda dengan mudah melalui dashboard ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Form Tambah Tenant -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Tambah Tenant Baru</h3>
                <form action="{{ route('tenant.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Tenant" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="email" name="email" placeholder="Email Tenant" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="password" name="password" placeholder="Password Tenant" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition">Tambah Tenant</button>
                </form>

                @if (session('success'))
                    <p class="mt-4 text-green-600 font-medium">{{ session('success') }}</p>
                @endif
            </div>

            <!-- List Tenant -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Daftar Tenant</h3>
                <ul class="space-y-2">
                    @forelse($tenants as $tenant)
                        <li class="border border-gray-200 rounded-md px-4 py-2 bg-gray-50">
                            <span class="font-semibold text-gray-800">{{ $tenant->name }}</span>
                            <br>
                            <span class="text-sm text-gray-500">{{ $tenant->email }}</span>
                        </li>
                    @empty
                        <li class="text-gray-500 italic">Belum ada tenant terdaftar.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Logout -->
        <div class="mt-8 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-md transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

</body>
</html>
