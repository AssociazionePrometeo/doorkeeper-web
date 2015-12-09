<?php

namespace App\Http\Controllers\Api;

use App\Resource;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Eloquent\Query\Builder;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $reservations = Reservation::active();

        return $this->afterId($request, $reservations)->get();
    }

    /**
     * Display the reservations associated to the specified resource.
     *
     * @param  Resource  $resource
     * @return Response
     */
    public function resource(Request $request, Resource $resource)
    {
        $reservations = $resource->reservations()->active();

        return $this->afterId($request, $reservations)->get();
    }

    /**
     * Add the optional after_id filter.
     *
     * @param Request $request
     * @param mixed $query
     */
    protected function afterId(Request $request, $query)
    {
        $lastId = (int) $request->get('after_id');

        if ($lastId > 0) {
            $query->where('id', '>', $lastId);
        }

        return $query;
    }
}
