<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Resource;
use App\Resevation;
use App\Http\Requests;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Resource::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $resource
     * @return Response
     */
    public function show(Resource $resource)
    {
        return $resource;
    }

    /**
     * Check if access is allowed given an RFID card identifier.
     *
     * @param   Resource  $resource
     * @param   string    $cardId
     * @return  Response
     */
    public function check(Resource $resource, $cardId)
    {
        $now = Date::now();

        try {
            $card = Card::findOrFail($cardId);

            // @todo: refactor for single responsibility
            $reservation = $resource->reservations()
                                    ->where('starts_at', '<=', $now)
                                    ->where('ends_at', '>', $now)
                                    ->where('user_id', '=', $card->user->id)
                                    ->first();

            $allow = $reservation ? true : false;
            //
        } catch (ModelNotFoundException $e) {
            $reservation = null;
            $allow = false;
        }

        return [
            'time' => $now->format('Y-m-d H:i:s'),
            'reservation' => $reservation,
            'allow' => $allow,
        ];
    }
}
