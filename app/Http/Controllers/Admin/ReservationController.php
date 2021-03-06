<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Reservation;
use App\User;
use App\Resource;
use DateTime;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservation.
     *
     * @return Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::lists('name', 'id');
        $resources = Resource::lists('name', 'id');

        return view('admin.reservations.create', compact('users', 'resources'));
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @return Response
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = new Reservation;
        $this->updateTimeFields($reservation, $request);
        $reservation->user()->associate($request->get('user_id'));
        $reservation->resource()->associate($request->get('resource_id'));
        $reservation->save();

        return redirect()->route('admin.reservations.index');
    }

    /**
     * Show the form for editing the specified reservation.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function edit(Reservation $reservation)
    {
        $users = User::lists('name', 'id');
        $resources = Resource::lists('name', 'id');

        return view('admin.reservations.edit', compact('reservation', 'users', 'resources'));
    }

    /**
     * Update the specified reservation in storage.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function update(Reservation $reservation, UpdateReservationRequest $request)
    {
        $reservation->user()->associate($request->get('user_id'));
        $reservation->resource()->associate($request->get('resource_id'));
        $this->updateTimeFields($reservation, $request);
        $reservation->save();

        return redirect()->route('admin.reservations.index');
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index');
    }

    protected function updateTimeFields(Reservation &$reservation, $request)
    {        
        $reservation->starts_at = $this->parseDateTime(
            $request->get('start_date'),
            $request->get('start_time')
        );

        $reservation->ends_at = $this->parseDateTime(
            $request->get('end_date'),
            $request->get('end_time')
        );
        
        return $reservation;
    }

    protected function parseDateTime($date, $time)
    {
        $time = date_parse_from_format('H:i', $time);
        $time['minute'] -= $time['minute'] % 30;

        $date = new DateTime($date);
        $date->setTime($time['hour'], $time['minute']);

        return $date;
    }
}
