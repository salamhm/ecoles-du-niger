@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('backend/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('backend/modules/dropzone/dropzone.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1><i class="fa fa-tags fa-sm"></i> {{ $pageTitle }}</h1>
    </div>
    @include('admin.partials.flash')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $subTitle }}</h4>
                    </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Général</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">Contacts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <form action="{{ route('admin.institutions.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nom</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $targetInstitution->name) }}">
                                            <input type="hidden" name="id" value="{{ $targetInstitution->id }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="custom-file mb-4 mt-3">
                                            <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo">
                                            <label class="custom-file-label" for="logo">Choisir un logo</label>
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="initials">Cygle</label>
                                                <input type="text" name="initials" id="initials" class="form-control @error('initials') is-invalid @enderror" value="{{ old('initials', $targetInstitution->initials) }}">
                                                @error('initials')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="institution_type">Type d'école</label>
                                                <select name="institution_type_id" id="institution_type" class="custom-select @error('institution_type_id') is-invalid @enderror">
                                                    <option value="0">Choisir un type d'école</option>
                                                    @foreach($institutionTypes as $institutionType)
                                                        @if($targetInstitution->institution_type_id == $institutionType->id)
                                                            <option value="{{ $institutionType->id }}" selected>{{ $institutionType->name }}</option>
                                                        @else
                                                            <option value="{{ $institutionType->id }}">{{ $institutionType->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('institution_type_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="address">Addresse</label>
                                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $targetInstitution->address) }}">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="city">Ville</label>
                                                <select name="city_id" id="city" class="custom-select @error('city_id') is-invalid @enderror">
                                                    <option value="0">Choisir une ville</option>
                                                    @foreach($cities as $city)
                                                        @if($targetInstitution->city_id == $city->id)
                                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                        @else
                                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="latitude">Latitude</label>
                                                <input type="latitude" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $targetInstitution->latitude) }}">
                                                @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="longitude">Longitude</label>
                                                <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $targetInstitution->longitude) }}">
                                                @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $targetInstitution->email) }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="website">Siteweb</label>
                                                <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $targetInstitution->website) }}">
                                                @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="presentation">Présentation</label>
                                            <textarea name="presentation" id="presentation" class="form-control @error('presentation') is-invalid @enderror summernote">{{ old('presentation', $targetInstitution->presentation) }}</textarea>
                                            @error('presentation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary mr-1" type="submit">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="profile-tab">
                                    <institution-contact :institutionid="{{ $targetInstitution->id }}"></institution-contact>
                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                                <input type="hidden" name="institution_id" value="{{ $targetInstitution->id }}">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="button" id="uploadButton">Upload Images
                                            </button>
                                        </div>
                                    </div>
                                    @if($targetInstitution->images)
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="gallery gallery-md">
                                            @foreach($targetInstitution->images as $image)
                                            <div class="gallery-item" data-image="{{ asset('storage/'.$image->full) }}" data-title="{{ 'Image  ' . $loop->iteration}}" href="{{ asset('storage/'.$image->full) }}" title="Image 1">
                                                <a class="float-right text-danger" href="{{ route('admin.institutions.images.delete', $image->id) }}">
                                                    <i class="fa fa-fw fa-lg fa-trash"></i>
                                                </a>
                                            </div>
                                            @endforeach
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@push('scripts')
<script src="{{ asset('backend/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/modules/dropzone/dropzone.min.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            addRemoveLinks: false,
            maxFilesize: 2,
            parallelUploads: 5,
            url: "{{ route('admin.institutions.images.upload') }}",
            autoProcessQueue: false,
        });
        myDropzone.on("queuecomplete", function (file) {
            window.location.reload();
        });
        $('#uploadButton').click(function(){
            if (myDropzone.files.length === 0) {
                alert('select images to upload');
            } else {
                myDropzone.processQueue();
            }
        });
    });
</script>

<script src="{{ asset('js/app.js') }}"></script>
@endpush