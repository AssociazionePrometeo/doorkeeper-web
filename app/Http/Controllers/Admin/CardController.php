<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Card;
use App\User;

class CardController extends Controller
{
    /**
     * Display a listing of the card.
     *
     * @return Response
     */
    public function index()
    {
        $cards = Card::all();

        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new card.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::lists('name', 'id');
     
        return view('admin.cards.create', compact('users'));
    }

    /**
     * Store a newly created card in storage.
     *
     * @return Response
     */
    public function store(CardRequest $request)
    {
        $card = new Card($request->only('id'));
        $card->user()->associate($request->get('user_id'));
        $card->save();

        return redirect()->route('admin.cards.index');
    }

    /**
     * Show the form for editing the specified card.
     *
     * @param  Card  $card
     * @return Response
     */
    public function edit(Card $card)
    {
        $users = User::lists('name', 'id');
        
        return view('admin.cards.edit', compact('card', 'users'));
    }

    /**
     * Update the specified card in storage.
     *
     * @param  Card  $card
     * @return Response
     */
    public function update(Card $card, CardRequest $request)
    {
        $card->id = $request->get('id');
        $card->user()->associate($request->get('user_id'));
        $card->save();

        return redirect()->route('admin.cards.index');
    }

    /**
     * Remove the specified card from storage.
     *
     * @param  Card  $card
     * @return Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()->route('admin.cards.index');
    }
}
