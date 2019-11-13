<?php

namespace App\Http\Controllers\Admin;

use App\DepartmentAddressTo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDepartmentAddressToRequest;
use App\Http\Requests\StoreDepartmentAddressToRequest;
use App\Http\Requests\UpdateDepartmentAddressToRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DepartmentAddressToController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DepartmentAddressTo::query()->select(sprintf('%s.*', (new DepartmentAddressTo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'department_address_to_show';
                $editGate      = 'department_address_to_edit';
                $deleteGate    = 'department_address_to_delete';
                $crudRoutePart = 'department-address-tos';

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
            $table->editColumn('dept_name_address', function ($row) {
                return $row->dept_name_address ? $row->dept_name_address : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.departmentAddressTos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('department_address_to_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentAddressTos.create');
    }

    public function store(StoreDepartmentAddressToRequest $request)
    {
        $departmentAddressTo = DepartmentAddressTo::create($request->all());

        return redirect()->route('admin.department-address-tos.index');
    }

    public function edit(DepartmentAddressTo $departmentAddressTo)
    {
        abort_if(Gate::denies('department_address_to_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentAddressTos.edit', compact('departmentAddressTo'));
    }

    public function update(UpdateDepartmentAddressToRequest $request, DepartmentAddressTo $departmentAddressTo)
    {
        $departmentAddressTo->update($request->all());

        return redirect()->route('admin.department-address-tos.index');
    }

    public function show(DepartmentAddressTo $departmentAddressTo)
    {
        abort_if(Gate::denies('department_address_to_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentAddressTos.show', compact('departmentAddressTo'));
    }

    public function destroy(DepartmentAddressTo $departmentAddressTo)
    {
        abort_if(Gate::denies('department_address_to_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentAddressTo->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentAddressToRequest $request)
    {
        DepartmentAddressTo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
