<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\TenantCompany;

class WebController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $company = Company::where('email', $request->email)->first();

        if (!$company || !Hash::check($request->password, $company->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        Auth::login($company);

        return redirect()->route('tenant.index');
    }


    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function indexTenant()
    {
        $tenants = \App\Models\TenantCompany::all();
        return view('tenan.index', compact('tenants'));
    }

    // Menyimpan data tenant baru
    public function createTenant(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'address' => 'required|string',
            'email' => 'required|email|unique:tenant_companies,email',
            'password' => 'required|min:6',
        ]);

        TenantCompany::create([
            'name' => $request->nama,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company_id' => auth()->user()->id,
            'role_id' => 2,
        ]);

        return redirect()->route('tenant.index')->with('success', 'Tenant berhasil ditambahkan.');
    }

    public function showCreateTenantForm()
    {
        return view('tenan.create'); 
    }


    public function editTenant($id)
    {
        $tenant = TenantCompany::findOrFail($id);
        return view('tenan.edit', compact('tenant'));
    }

    public function updateTenant(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:tenant_companies,email,' . $id,
            'address' => 'required|string',
        ]);

        $tenant = TenantCompany::findOrFail($id);
        $tenant->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tenant berhasil diperbarui.');
    }

    public function destroyTenant($id)
    {
        $tenant = TenantCompany::findOrFail($id);
        $tenant->delete();

        return redirect()->route('dashboard')->with('success', 'Tenant berhasil dihapus.');
    }
}
