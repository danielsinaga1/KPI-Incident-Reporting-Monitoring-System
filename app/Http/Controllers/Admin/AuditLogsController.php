<?php

namespace App\Http\Controllers\Admin;

use App\AuditLog;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class AuditLogsController extends Controller
{
    public function index() {
        abort_if(Gate::denies('audit_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditLogs = AuditLog::all();

        return view('admin.auditLogs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        abort_if(Gate::denies('audit_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.auditLogs.show', compact('auditLog'));
    }
}
