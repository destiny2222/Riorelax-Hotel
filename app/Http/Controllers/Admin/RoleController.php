<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of roles
     */
    public function index()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to manage roles.');
            return redirect()->route('admin.home');
        }

                $roles = Role::with(['permissions', 'admins'])->latest()->paginate(15);
        
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to create roles.');
            return redirect()->route('admin.home');
        }

        $permissions = Permission::orderBy('name')->get();
        
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to create roles.');
            return redirect()->route('admin.home');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            // Create the role
            $role = Role::create([
                'name' => strtolower(str_replace(' ', '-', $request->name)),
                'guard_name' => 'admin',
            ]);

            // Sync permissions if provided
            if ($request->permissions) {
                $role->syncPermissions($request->permissions);
            }

            Alert::success('Success', 'Role created successfully.');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Log::error('Failed to create role: ' . $e->getMessage());
            Alert::error('Error', 'Failed to create role.');
            return back()->withInput();
        }
    }

    /**
     * Display the specified role
     */
    public function show($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to view roles.');
            return redirect()->route('admin.home');
        }

        $role = Role::with('permissions')->findOrFail($id);
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to edit roles.');
            return redirect()->route('admin.home');
        }

        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, $id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to update roles.');
            return redirect()->route('admin.home');
        }

        $role = Role::findOrFail($id);

        // Prevent editing of system roles
        $systemRoles = ['super-admin', 'supervisor', 'front-desk'];
        if (in_array($role->name, $systemRoles)) {
            Alert::warning('System Role', 'System roles cannot be modified.');
            return back();
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            // Update the role
            $role->update([
                'name' => strtolower(str_replace(' ', '-', $request->name)),
            ]);

            // Sync permissions
            $role->syncPermissions($request->permissions ?? []);

            Alert::success('Success', 'Role updated successfully.');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Log::error('Failed to update role: ' . $e->getMessage());
            Alert::error('Error', 'Failed to update role.');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified role
     */
    public function destroy($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasRole('super-admin')) {
            Alert::error('Access Denied', 'You do not have permission to delete roles.');
            return redirect()->route('admin.home');
        }

        try {
            $role = Role::findOrFail($id);

            // Prevent deletion of system roles
            $systemRoles = ['super-admin', 'supervisor', 'front-desk'];
            if (in_array($role->name, $systemRoles)) {
                Alert::warning('System Role', 'System roles cannot be deleted.');
                return back();
            }

            // Check if role is assigned to any admins
            if ($role->admins()->exists()) {
                Alert::warning('Role In Use', 'Cannot delete role that is assigned to staff members.');
                return back();
            }

            $role->delete();

            Alert::success('Success', 'Role deleted successfully.');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Log::error('Failed to delete role: ' . $e->getMessage());
            Alert::error('Error', 'Failed to delete role.');
            return back();
        }
    }
}
