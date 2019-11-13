<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRootCauseRequest;
use App\Http\Requests\UpdateRootCauseRequest;
use App\Http\Resources\Admin\RootCauseResource;
use App\RootCause;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RootCauseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('root_cause_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RootCauseResource(RootCause::all());
    }

    public function store(StoreRootCauseRequest $request)
    {
        $rootCause = RootCause::create($request->all());

        return (new RootCauseResource($rootCause))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RootCause $rootCause)
    {
        abort_if(Gate::denies('root_cause_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RootCauseResource($rootCause);
    }

    public function update(UpdateRootCauseRequest $request, RootCause $rootCause)
    {
        $rootCause->update($request->all());

        return (new RootCauseResource($rootCause))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RootCause $rootCause)
    {
        abort_if(Gate::denies('root_cause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rootCause->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
