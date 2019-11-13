<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRootCauseRequest;
use App\Http\Requests\StoreRootCauseRequest;
use App\Http\Requests\UpdateRootCauseRequest;
use App\RootCause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RootCauseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('root_cause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rootCauses = RootCause::all();

        return view('admin.rootCauses.index', compact('rootCauses'));
    }

    public function create()
    {
        abort_if(Gate::denies('root_cause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rootCauses.create');
    }

    public function store(StoreRootCauseRequest $request)
    {
        $rootCause = RootCause::create($request->all());

        return redirect()->route('admin.root-causes.index');
    }

    public function edit(RootCause $rootCause)
    {
        abort_if(Gate::denies('root_cause_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rootCauses.edit', compact('rootCause'));
    }

    public function update(UpdateRootCauseRequest $request, RootCause $rootCause)
    {
        $rootCause->update($request->all());

        return redirect()->route('admin.root-causes.index');
    }

    public function show(RootCause $rootCause)
    {
        abort_if(Gate::denies('root_cause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rootCauses.show', compact('rootCause'));
    }

    public function destroy(RootCause $rootCause)
    {
        abort_if(Gate::denies('root_cause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rootCause->delete();

        return back();
    }

    public function massDestroy(MassDestroyRootCauseRequest $request)
    {
        RootCause::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
