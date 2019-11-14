<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DesignationDepartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesignationDepartmentRequest;
use App\Http\Requests\UpdateDesignationDepartmentRequest;
use App\Http\Resources\Admin\DesignationDepartmentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DesignationDepartmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('department_address_to_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentAddressToResource(DepartmentAddressTo::all());
    }

    public function store(StoreDepartmentAddressToRequest $request)
    {
        $departmentAddressTo = DepartmentAddressTo::create($request->all());

        return (new DepartmentAddressToResource($departmentAddressTo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DepartmentAddressTo $departmentAddressTo)
    {
        abort_if(Gate::denies('department_address_to_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentAddressToResource($departmentAddressTo);
    }

    public function update(UpdateDepartmentAddressToRequest $request, DepartmentAddressTo $departmentAddressTo)
    {
        $departmentAddressTo->update($request->all());

        return (new DepartmentAddressToResource($departmentAddressTo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DepartmentAddressTo $departmentAddressTo)
    {
        abort_if(Gate::denies('department_address_to_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentAddressTo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
