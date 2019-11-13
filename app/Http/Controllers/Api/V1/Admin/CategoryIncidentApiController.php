<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CategoryIncident;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryIncidentRequest;
use App\Http\Requests\UpdateCategoryIncidentRequest;
use App\Http\Resources\Admin\CategoryIncidentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryIncidentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_incident_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryIncidentResource(CategoryIncident::with(['team'])->get());
    }

    public function store(StoreCategoryIncidentRequest $request)
    {
        $categoryIncident = CategoryIncident::create($request->all());

        return (new CategoryIncidentResource($categoryIncident))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CategoryIncident $categoryIncident)
    {
        abort_if(Gate::denies('category_incident_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryIncidentResource($categoryIncident->load(['team']));
    }

    public function update(UpdateCategoryIncidentRequest $request, CategoryIncident $categoryIncident)
    {
        $categoryIncident->update($request->all());

        return (new CategoryIncidentResource($categoryIncident))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CategoryIncident $categoryIncident)
    {
        abort_if(Gate::denies('category_incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncident->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
