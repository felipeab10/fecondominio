<?php

namespace App\Http\Controllers\API;
use App\condominioAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CondominioAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return condominioAdmin::latest()->paginate('10');
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
      return condominioAdmin::create([
      'nome'=>$request['nome'],
      'cnpj'=>$request['cnpj'],
      'dt_inauguracao'=>$request['dt_inauguracao'],
      'cep'=>$request['cep'],
      'endereco'=>$request['endereco'],
      'numero'=>$request['numero'],
      'bairro'=>$request['bairro'],
      'complemento'=>$request['complemento'],
      'cidade'=>$request['cidade'],
      'estado'=>$request['estado'],
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
    }
}
