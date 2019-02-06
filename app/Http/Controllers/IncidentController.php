<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incident;
use App\Http\Requests\StoreIncidentRequest;
use App\Stage;
use Illuminate\Support\Facades\Auth;
use App\User;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginated = Incident::paginate(10);
        return view('incidents.index', compact('paginated','nip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidents.create');
    }

    /**
     * Store a newly created resource in storage.
     * insert data ke tabel incident
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncidentRequest $request)
    {
        $incident = new Incident();
        $incident->description = $request->input('description');
        $incident->impact = $request->input('impact');
        $incident->user_id = Auth::user()->id;
        $incident->stage_id = Stage::waitingForServiceDesk()->first()->id;
        $incident->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','incident berhasil di buat');
    }

    /**
     * Display the specified resource.
     * dapatkan jumlah notifikasi
     * baca nottifikasi berdasarkan user dan stage nya
     * redirect ke view incidents/show.blade.php
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        $count = Auth::user()->unreadNotifications->count();
        if($count > 0)
        {
            $notification = Auth::user()->notifications->filter(function($item, $key) use($incident){
                return $item->data['id'] == $incident->id and  $item->data['stage_id'] == 4;
            })->first();
            $notification->markAsRead();
        }
        
        return view('incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     * menampilkan form edit
     * letak file berada di direktori incidents/edit.blade.php
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incidents)
    {
        $incidents->description = $request->input('description');
        $incidents->impact = $request->input('impact');
        $incidents->user_id = Auth::user()->id;
        $incidents->stage_id = Stage::waitingForServiceDesk()->first()->id;
        $incidents->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','incident berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return redirect()
            ->route('incidents.index')
            ->with('success','incident berhasil di delete');
    }

    public function detailsave(Request $request, Incident $incidents, $id)
    {
        $incidents = Incident::find($id);
        $incidents->detail = $request->input('detail');
        $incidents->stage_id = Stage::waitingUserConf()->first()->id;
        $incidents->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','Detail berhasil di input, Terimkasih');
    }

    public function detailshow(Incident $incident)
    {
        return view('incidentapprovals.edit', compact('incident'));
    }

    public function approveshow(Request $request, Incident $incidents, $id)
    {
        $incidents = Incident::find($id);
        $incidents->stage_id = Stage::closed()->first()->id;
        $incidents->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','Incident disetujui');
    }

    public function rejectshow(Request $request, Incident $incidents, $id)
    {
        $incidents = Incident::find($id);
        $incidents->stage_id = Stage::waitingForServiceDesk()->first()->id;
        $incidents->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','Incident berhasil ditolak');
    }

    public function ticketshow(Incident $incident)
    {
        return view('incidentapprovals.ticket', compact('incident'));
    }

    public function ticketcreated(Request $request, Incident $incidents, $id)
    {
        $incidents = Incident::find($id);
        $incidents->stage_id = Stage::ticketCreated()->first()->id;
        $incidents->ticket = $request->input('ticket');
        $incidents->save();
        return redirect()
            ->route('incidents.index')
            ->with('success','Nomor ticket berhasil di input');
    }
    
}
