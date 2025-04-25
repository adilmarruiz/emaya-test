<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user');

        // filtros opcionales
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return $query->latest()->paginate(15);
    }
}
