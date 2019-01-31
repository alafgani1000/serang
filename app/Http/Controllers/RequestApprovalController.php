<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestApproval;
use App\ITRequest;
use App\Service;
use App\Stage;
use App\Status;
use Spatie\Permission\Models\Role;
use App\Notifications\RequestBossApproved;

class RequestApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ('tis');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $services = Service::all();
        $requests = ITRequest::find($id);
        return view('requestApprovals.edit', compact('requests','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $request = ITRequest::find($id);
        $request->stage_id = Stage::waitingForOperationDesk()->first()->id;
        $request->save();

        $ra = RequestApproval::where('active', 1)
                ->where('destination', 'San Diego')
                ->update(['delayed' => 1]);
        
        return redirect()
            ->route('requests.index')
            ->with('success','Request berhasil disetujui');
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
