<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\TenantCompany;
use App\Models\Karyawan;

class AuthController extends Controller
{
    public function loginCompany(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $company = Company::where('email', $request->email)->first();

        if (!$company || !Hash::check($request->password, $company->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $company->createToken('company-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $company,
        ]);
    }

    public function createTenant(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:tenant_companies,email',
            'password' => 'required|string|min:6',
        ]);

        $company = $request->user(); 

        $tenant = TenantCompany::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $company->id,
            'role_id' => 2, 
        ]);
        

        return response()->json([
            'message' => 'Tenant created successfully',
            'tenant' => $tenant
        ]);
    }



    public function loginTenant(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $tenant = TenantCompany::where('email', $request->email)->first();

        if (!$tenant || !Hash::check($request->password, $tenant->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $tenant->createToken('tenant-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $tenant,
        ]);
    }

    public function registerKaryawan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6',
            'tenant_company_id' => 'required|exists:tenant_companies,id'
        ]);

        $employees = Employees::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tenant_company_id' => $request->tenant_company_id,
            'role_id' => 3, 
        ]);        

        return response()->json([
            'success' => true,
            'message' => 'Employee registered successfully',
            'data' => $employees
        ], 200);        
    }

    public function loginKaryawan(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $employees = Employees::where('email', $request->email)->first();

            if (!$employees || !Hash::check($request->password, $employees->password)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $token = $employees->createToken('employees-token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage(), // tampilkan errornya langsung
            ], 500);
        }
    }

    public function getTenants()
    {
        $tenants = TenantCompany::select('id', 'name')->get();

        return response()->json([
            'data' => $tenants
        ]);
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
