<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\TenantCompany;

class WebController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $company = Company::where('email', $request->email)->first();

        if (!$company || !Hash::check($request->password, $company->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        Auth::login($company);

        return redirect()->route('dashboard'); 
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $company = auth()->user();
        $tenants = TenantCompany::where('company_id', $company->id)->get();
        return view('dashboard', compact('company', 'tenants'));
    }

    public function createTenant(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:tenant_companies,email',
            'password' => 'required|min:6',
        ]);

        TenantCompany::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tenant created successfully.');
    }
}
