<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangeRoleRequest; // Tambahkan ini
use App\Models\User; // Tambahkan ini
use App\Services\RoleManagementService; // Tambahkan ini
use Illuminate\Http\RedirectResponse; // Tambahkan ini

class RoleController extends Controller
{
    public function update(
        ChangeRoleRequest $request,
        User $user,
        RoleManagementService $service
    ) : RedirectResponse {
        $data = $request->validated();
        $service->changeRole($request->user(), $user, $data['role']);
        return back()->with('status', 'Role Diperbarui');
    }
}