<?php

namespace App\Http\Controllers\Admin;

use App\DesignationDepartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDesignationDepartmentRequest;
use App\Http\Requests\StoreDesignationDepartmentRequest;
use App\Http\Requests\UpdateDesignationDepartmentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DesignationDepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DesignationDepartment::query()->select(sprintf('%s.*', (new DesignationDepartment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'designation_department_show';
                $editGate      = 'designation_department_edit';
                $deleteGate    = 'designation_department_delete';
                $crudRoutePart = 'designation-departments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('cc_code', function ($row) {
                return $row->cc_code ? $row->cc_code : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.designationDepartments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('designation_department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.designationDepartments.create');
    }

    public function store(StoreDesignationDepartmentRequest $request)
    {
        $dept_designation = DesignationDepartment::create($request->all());

        return redirect()->route('admin.designation-departments.index');
    }

    public function edit(DesignationDepartment $designationDepartment)
    {
        abort_if(Gate::denies('designation_department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.designationDepartments.edit', compact('designationDepartment'));
    }

    public function update(UpdateDesignationDepartmentRequest $request, DesignationDepartment $designationDepartment)
    {
        $designationDepartment->update($request->all());

        return redirect()->route('admin.designation-departments.index');
    }

    public function show(DesignationDepartment $designationDepartment)
    {
        abort_if(Gate::denies('designation_department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.designationDepartments.show', compact('designationDepartment'));
    }

    public function destroy(DesignationDepartment $designationDepartment)
    {
        abort_if(Gate::denies('designation_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designationDepartment->delete();

        return back();
    }

    public function massDestroy(MassDestroyDesignationDepartmentRequest $request)
    {
        DesignationDepartment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
