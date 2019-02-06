@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="boss">Pengesahan oleh atasan</label>
                                <input readonly type="text"  name="boss" class="form-control {{ $errors->has('boss') ? ' is-invalid' : '' }}" autofocus value="{{Auth::user()->boss()->name}} ({{Auth::user()->boss()->id}})" />
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('boss') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="title">Judul</label>
                                <input  name="title" id="summernote" rows="2" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" autofocus value="{{ old('title') }}" />
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="service_id">Layanan</label>
                                    <select id="idservice" name="service_id" class="form-control {{ $errors->has('service_id') ? ' is-invalid' : '' }}">
                                            <option>Pilih Layanan</option>
                                        @foreach ($services as $service)
                                            <option value={{$service->id}}>{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group" >
                                <div class="col-md-12">
                                    <label for="category">Kategori Layanan</label>
                                    <select id="idcategories" name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}">
                                        <option>Pilih Kategori</option>
                                        <option value="tes">Pilih Kategori</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_need">Alasan Permintaan</label>
                                <textarea  name="business_need" id="summernote" rows="6" class="form-control {{ $errors->has('business_need') ? ' is-invalid' : '' }}" autofocus>{{ old('business_need') }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_need') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_benefit">Manfaat Terhadap Bisnis</label>
                                <textarea  name="business_benefit" rows="6" class="form-control {{ $errors->has('business_benefit') ? ' is-invalid' : '' }}" autofocus>{{ old('business_benefit') }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_benefit') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="keterangan">Keterangan tambahan ( jenis aplikasi, level akses, dll)</label>
                                <textarea  name="keterangan" rows="4" class="form-control {{ $errors->has('business_benefit') ? ' is-invalid' : '' }}" autofocus>{{ old('keterangan') }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="customFile">Lampiran</label>
                                <input type="file" class="form-control {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="customFile" name="attachment">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('attachment') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <br/>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="nda" name="nda" value='1'>
                                    <label class="custom-control-label" for="customCheck1">Kebijakan dan Aturan Penggunaan Layanan <span type="button" class="badge badge-danger" data-toggle="modal" data-target="#myModal">Show NDA</span></label>
                                </div>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nda') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <br/>
                                <div class="btn-group mb-3" role="group">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                <p>This is a large modal.</p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection