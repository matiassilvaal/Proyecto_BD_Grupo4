<?php

/**
 * En el update, si introduzco un 0,
 * el chequeo de !empty considera que
 * 0 es vacio, y no entra a cambiar
 * $card->Tipo en ese caso.
 */


namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        if($cards->isEmpty()){
            return response()->json([], 204);
        }
        return response($cards, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'Tipo' => 'required'
            ],
            [
                'Tipo.required' => 'Debes ingresar un tipo de tarjeta',
            ]
        );
        if ($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCard = new Card();
        if($request->Tipo == true || $request->Tipo == false || $request->Tipo == 1 || $request->Tipo == 0){
          $newCard->Tipo = $request->Tipo;
        }
        else{
            return response()->json([
                'msg' => 'El parametro Tipo debe ser booleano',
                'id' => $newCard->id
            ], 204);
        }
        $newCard->soft = false;
        $newCard->save();

        return response()->json([
            'msg' => 'New card has been created',
            'id' => $newCard->id,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        return response($card, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'Tipo' => 'nullable'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }

        if($request->Tipo == $card->Tipo){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales.'
            ], 404);
        }
        
        if($request->Tipo == true || $request->Tipo == 1){
            $card->Tipo = $request->Tipo;
        }
        else{
            $card->Tipo = false;
        }


        $card->save();
        return response()->json([
            'msg' => 'Card has been edited',
            'id' => $card->id,
            'val' => $card->Tipo,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        $card->delete();
        return response()->json([
            'msg' => 'Card has been deleted',
            'id' => $card->id,
        ], 200);
    }
    public function soft($id)
    {
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        if($card->soft == true){
          return response()->json([
            'msg' => 'La tarjeta ya esta borrada (soft deleted)',
            'id' => $card->id,
          ], 200);
        }

        $card->soft = true;
        $card->save();
        return response()->json([
            'msg' => 'Card has been soft deleted',
            'id' => $card->id,
        ], 200);
    }
    public function restore($id)
    {
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        if($card->soft == false){
          return response()->json([
            'msg' => 'La tarjeta no esta borrado',
            'id' => $card->id,
          ], 200);
        }

        $card->soft = false;
        $card->save();
        return response()->json([
            'msg' => 'Card has been restored',
            'id' => $card->id,
        ], 200);
    }
}
