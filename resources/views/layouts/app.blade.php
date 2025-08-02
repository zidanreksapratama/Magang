<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Multi-Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CDN (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link ke file CSS -->
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">MultiCompany</h4>
        <hr>
        <a href="{{ route('tenant.index') }}">Tenant Company</a>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>