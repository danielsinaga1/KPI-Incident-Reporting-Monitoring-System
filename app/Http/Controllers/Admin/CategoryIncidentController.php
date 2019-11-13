<?php

namespace App\Http\Controllers\Admin;

use App\CategoryIncident;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryIncidentRequest;
use App\Http\Requests\StoreCategoryIncidentRequest;
use App\Http\Requests\UpdateCategoryIncidentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryIncidentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_incident_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncidents = CategoryIncident::all();

        return view('admin.categoryIncidents.index', compact('categoryIncidents'));
    }

    public function create()
    {
        abort_if(Gate::denies('category_incident_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoryIncidents.create');
    }

    public function store(StoreCategoryIncidentRequest $request)
    {
        $categoryIncident = CategoryIncident::create($request->all());

        return redirect()->route('admin.category-incidents.index');
    }

    public function edit(CategoryIncident $categoryIncident)
    {
        abort_if(Gate::denies('category_incident_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncident->load('team');

        return view('admin.categoryIncidents.edit', compact('categoryIncident'));
    }

    public function update(UpdateCategoryIncidentRequest $request, CategoryIncident $categoryIncident)
    {
        $categoryIncident->update($request->all());

        return redirect()->route('admin.category-incidents.index');
    }

    public function show(CategoryIncident $categoryIncident)
    {
        abort_if(Gate::denies('category_incident_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncident->load('team');

        return view('admin.categoryIncidents.show', compact('categoryIncident'));
    }

    public function destroy(CategoryIncident $categoryIncident)
    {
        abort_if(Gate::denies('category_incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncident->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryIncidentRequest $request)
    {
        CategoryIncident::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
