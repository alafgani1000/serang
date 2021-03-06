<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ITRequest;
use App\Service;
use App\Stage;
use App\Status;
use App\Category;
use App\RequestApproval;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreITRequestRequest;
use App\Http\Requests\ApprovrsaveITRequestRequest;
use Illuminate\Support\Facades\Storage;
use App\Notifications\RequestCreated;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RequestReasonfile;
use App\RequestAttachment;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginated = ITRequest::paginate();
        return view('requests.index',compact('paginated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('requests.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreITRequestRequest $request)
    {
        $r = new ITRequest();
        //$r->attachment          = $request->file('attachment')->store('attachments');
        $r->service_id          = $request->input('service_id');
        $r->title               = $request->input('title');
        $r->business_need       = $request->input('business_need');
        $r->business_benefit    = $request->input('business_benefit');
        $r->stage_id            = Stage::waitingBossApproval()->first()->id;
        $r->category_id         = $request->input('category');
        $r->keterangan          = $request->input('keterangan');
        $r->nda                 = $request->input('nda');
        $r->user_id             = Auth::user()->id;
        $r->save();

        foreach($request->file('attachment') as $files)
        {
            $item = $files->store('attachments');
            $r->requestAttacments()->save(new RequestAttachment(['attachment' => $item]));
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Request Berhasil dikirim');
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
    public function edit(ITRequest $request)
    {
        $services = Service::all();
        return view('requests.edit', compact('request','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, ITRequest $request)
    {
        if($r->hasFile('attachment')){
            Storage::delete($request->attachment);
            $request ->attachment = $r->file('attachment')->store('attachments');
        }
        $request ->service_id = $r->input('service_id');
        $request ->business_need = $r->input('business_need');
        $request ->business_benefit = $r->input('business_benefit');
        $request ->user_id = Auth::user()->id;
        $request ->save();
        return redirect()
            ->route('requests.index')
            ->with('success','Request Berhasil di edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ITRequest $request)
    {
        $request->delete();
        Storage::delete($request->attachment);
        return redirect()
            ->route('requests.index')
            ->with('success','Request Berhasil di hapus');
    }

    public function approvesave(Request $r, ITRequest $request)
    {

        if($r->input('aksi') == "1")
        {
            // update stage
            if($r->input('categories') == 2)
            {
                $request->stage_id = Stage::waitingForOperationDesk()->first()->id;
                $request->service_id = $r->input('service_id');
                $request->title = $r->input('title');
                $request->business_need = $r->input('business_need');
                $request->business_benefit = $r->input('business_benefit');
                $request->category_id = $r->input('categories');
                $request->save();
            }
            elseif($r->input('categories') == 1)
            {
                $request->stage_id = Stage::waitingForServiceDesk()->first()->id;
                $request->service_id = $r->input('service_id');
                $request->title = $r->input('title');
                $request->business_need = $r->input('business_need');
                $request->business_benefit = $r->input('business_benefit');
                $request->category_id = $r->input('categories');
                $request->save();
            }
            // save request approvals
            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->status_id = Status::approved()->first()->id;
            $ra->stage_id = Stage::waitingForOperationDesk()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 1;
            })->first();
            if(isset($notification))
            {
                $notification->markAsRead();
            }

            // redirect
            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil disetujui');
        }
        elseif($r->input('aksi') == "2")
        {
            $request->stage_id = Stage::requestRejected()->first()->id;
            $request->save();
    
            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->status_id = Status::rejected()->first()->id;
            $ra->stage_id = Stage::requestRejected()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 1;
            })->first();
            if(isset($notification))
            {
                $notification->markAsRead();
            }
    
            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil ditolak');
        }
    }

    public function soapprove(Request $r, ITRequest $request)
    {
        if($r->input('aksi') == "1")
        {
            // update stage
            // $request->stage_id = Stage::waitingForServiceDesk()->first()->id;
            $request->stage_id = Stage::waitingForOperationIct()->first()->id;
            $request->reason = $r->input('reason');
            $request->save();
            // save request approvals
            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->status_id = Status::approved()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 10;
            })->first();
            $notification->markAsRead();

            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil disetujui');
        }
        elseif($r->input('aksi') == "2")
        {
            $request->stage_id = Stage::requestDenied()->first()->id;
            $request->reason = $r->input('reason');
            $request->save();
    
            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->status_id = Status::rejected()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 10;
            })->first();
            $notification->markAsRead();
    
            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil ditolak');
        }

    }

    public function spsdapprove(Request $r, ITRequest $request)
    {
        // update stage
        // $request->stage_id = Stage::waitingForOperationIct()->first()->id;
        $request->stage_id = Stage::waitingForServiceDesk()->first()->id;
        $request->save();
        // save request approvals
        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::approved()->first()->id;
        $ra->stage_id = Stage::waitingForServiceDesk()->first()->id;
        $ra->save();

        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == $request->id and $item->data['stage_id'] == 2;
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Request berhasil disetujui');

    }

    public function approveshow(ITRequest $request)
    {
        $services = Service::all();
        $categories = Category::all();
        return view('requestapprovals.edit', compact('request','services','categories'));
    }

    public function escalationshow(ITRequest $request)
    {
        $services = Service::all();
        $categories = Category::all();
        $roles = Role::where('name','like','%so%')->get();
        return view('requestapprovals.escalation', compact('request','services','categories','roles'));
    }

    public function editrecomedation(ITRequest $request)
    {
        $services = Service::all();
        $categories = Category::all();
        $roles = Role::where('name','like','%so%')->get();
        return view('requestapprovals.recomendation', compact('request','services','categories','roles'));
    }

    public function editdetail(ITRequest $request)
    {
        $services = Service::all();
        $categories = Category::all();
        return view('requests.editdetail', compact('request','services','categories'));
    }

    public function editticket(ITRequest $request)
    {
        $services = Service::all();
        $categories = Category::all();
        return view('requests.editticket', compact('request','services','categories'));
    }

    public function showvalidasi(ITRequest $request)
    {
        $services = Service::all();
        return view('requestapprovals.recomendation', compact('request','services'));
    }

    public function editreject(ITRequest $request)
    {
        $services = Service::all();
        return view('requestapprovals.editreject', compact('request','services'));
    }

    public function updaterecomendation(Request $r, ITRequest $request)
    {
        $request->stage_id  = Stage::waitingForOperationIct()->first()->id;
        $request->reason    = $r->input('reason');
        $request->save();

        foreach( $r->file('attachment') as $files)
        {
            $rfiles = new RequestReasonfile();
            $rfiles->attachment = $files->store('attachments');
            $rfiles->request_id = $request->id;
            $rfiles->save();
        }

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id    = Auth::user()->id;
        $ra->status_id  = Status::approved()->first()->id;
        $ra->stage_id   = Stage::waitingForOperationIct()->first()->id;
        $ra->save();

        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == $request->id and $item->data['stage_id'] == 10;
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','rekomendasi berhasil dikirim');
    }

    public function updatedetail(Request $r, ITRequest $request)
    {
        $request->stage_id  = Stage::waitingUserConf()->first()->id;
        $request->detail    = $r->input('detail');
        $request->save();

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id    = Auth::user()->id;
        $ra->status_id  = Status::approved()->first()->id;
        $ra->stage_id   = Stage::waitingUserConf()->first()->id;
        $ra->save();

        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == $request->id and $item->data['stage_id'] == 4;
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Detail layanan berhasil di input');
    }

    public function updateticket(Request $r, ITRequest $request)
    {
        $request->stage_id = Stage::ticketCreated()->first()->id;
        $request->ticket = $r->input('ticket');
        $request->save();

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id    = Auth::user()->id;
        $ra->status_id  = Status::approved()->first()->id;
        $ra->stage_id   = Stage::ticketCreated()->first()->id;
        $ra->save();

        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == $request->id and $item->data['stage_id'] == 3;
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Nomor ticket kaseya berhasil di input');
    }

    public function soreject(ITRequest $request)
    {
        $request->stage_id = Stage::requestDenied()->first()->id;
        $request->save();

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::rejected()->first()->id;
        $ra->save();

        return redirect()
            ->route('requests.index')
            ->with('success','Request berhasil ditolak');
    }

    public function bossreject(Request $r, ITRequest $request)
    {
        $request->stage_id = Stage::requestDenied()->first()->id;
        $request->save();

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::rejected()->first()->id;
        $ra->save();

        return redirect()
            ->route('requests.index')
            ->with('success','Request berhasil ditolak');
    }

    public function employeeapprove(Request $r, ITRequest $request)
    {
        $request->stage_id = Stage::closed()->first()->id;
        $request->save();

        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::approved()->first()->id;
        $ra->stage_id = Stage::closed()->first()->id;
        $ra->save();

        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == $request->id and $item->data['stage_id'] == 6;
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Request disetujui oleh user');
    }

    public function spictapprove(Request $r, ITRequest $request)
    {
        if($r->input('aksi') == "1")
        {
            $request->stage_id = Stage::waitingForServiceDesk()->first()->id;
            $request->save();

            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->stage_id = Stage::waitingForServiceDesk()->first()->id;
            $ra->status_id = Status::approved()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 7;
            })->first();
            if(isset($notification))
            {
                $notification->markAsRead();
            }

            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil di setujui');
        }
        else
        {
            $request->stage_id = Stage::requestRejected()->first()->id;
            $request->save();

            $ra = new RequestApproval();
            $ra->request_id = $request->id;
            $ra->user_id = Auth::user()->id;
            $ra->stage_id = Stage::requestRejected()->first()->id;
            $ra->status_id = Status::rejected()->first()->id;
            $ra->save();

            $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
                return $item->data['id'] == $request->id and $item->data['stage_id'] == 7;
            })->first();
            if(isset($notification))
            {
                $notification->markAsRead();
            }

            return redirect()
                ->route('requests.index')
                ->with('success','Request berhasil ditolak');
        }
    }

    public function eskalasiso(Request $r, ITRequest $request)
    {
        if($r->has('so'))
        {
            $roleso = $r->input('so');
        }
        else
        {
            $roleso = Service::find($request->service_id)->role_id;
        }
        $request->stage_id = Stage::waitingForSoApproval()->first()->id;
        $request->so = $roleso;
        $request->save();
        // save  request approval
        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::approved()->first()->id;
        $ra->stage_id = Stage::waitingForSoApproval()->first()->id;
        $ra->save();
        // read notification
        $notification = Auth::user()->notifications->filter(function($item, $key) use($request){
            return $item->data['id'] == ( $request->id and $item->data['stage_id'] == 2 or $request->id and $item->data['stage_id'] == 7);
        })->first();
        if(isset($notification))
        {
            $notification->markAsRead();
        }

        return redirect()
            ->route('requests.index')
            ->with('success','Request berhasil di eskalasi ke Service Owner');
    }
    
}