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
        abort_if(Gate::denies('designation_department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesignationDepartmentResource(DesignationDepartment::all());
    }

    public function store(StoreDesignationDepartmentRequest $request)
    {
        $designationDepartment = DesignationDepartment::create($request->all());

        return (new DesignationDepartmentResource($designationDepartment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DesignationDepartment $designationDepartment)
    {
        abort_if(Gate::denies('designation_department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesignationDepartmentResource($designationDepartment);
    }

    public function update(UpdateDesignationDepartmentRequest $request, DesignationDepartment $designationDepartment)
    {
        $designationDepartment->update($request->all());

        return (new DesignationDepartmentResource($designationDepartment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DesignationDepartment $designationDepartment)
    {
        abort_if(Gate::denies('designation_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designationDepartment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
