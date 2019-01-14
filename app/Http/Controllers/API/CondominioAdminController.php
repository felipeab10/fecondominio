<?php

namespace App\Http\Controllers\API;
use App\condominioAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CondominioAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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

        $this->validate($request,[
            'nome' => 'required|string|max:191',
            'cnpj' => 'required|string|unique:condominio_admins',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:191',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:191',
            'cidade' => 'required|string|max:191',
            'estado' =>'required|string|max:191',
            'email' => 'required|string|email|max:191',

        ]);

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
      'status'=>$request['status'],
      'email'=>$request['email'],
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
        $views = condominioAdmin::findOrFail($id);
        return view('view-condominio',compact($views));
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
