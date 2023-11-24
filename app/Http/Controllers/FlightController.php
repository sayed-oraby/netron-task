<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Flight as modelRequest;
use App\Models\Flight as Model;

class FlightController extends Controller
{

    private $view = 'website.flights.';
    private $redirect = 'flights';



    public function index()
    {
        $flights = Model::select(['id','offer_id','caree','total_fare','currency'])->paginate(10);
        return view($this->view . 'index',compact('flights'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(modelRequest $request)
    {
        $flight = Model::create($this->gteInput($request,null));

        return redirect($this->redirect)->with('success','created successfully');
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
        $flight = Model::findOrFail($id);
        return view($this->view . 'edit', [ 'flight' => $flight ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(modelRequest $request, $id)
    {
        $flight = Model::findOrFail($id);

        $flight->update($this->gteInput($request,$flight));

        return redirect()->back()->with('info','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Model::findOrFail($id);

        $flight->delete();

        return redirect($this->redirect)->with('error','deleted successfully');
    }


    private function gteInput($request,$modelClass) {

        $input = $request->only([
            'offer_id','caree','total_fare','currency'
        ]);

        return  $input;
    }


}
