@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1><i class="fa fa-tags fa-sm"></i> {{ $pageTitle }}</h1>
    </div>
    @include('admin.partials.flash')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $subTitle }}</h4>
                    </div>
                    <form action="{{ route('admin.categories.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $targetCategory->name) }}">
                                <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="100" style="height: 100%;">{{ old('description', $targetCategory->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select name="parent_id" id="parent" class="custom-select @error('parent_id') is-invalid @enderror">
                                    <option value="0">Choisir la catégorie parente</option>
                                    @foreach($categories as $category)
                                        @if($targetCategory->parent_id == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="featured" class="custom-switch-input"
                                        {{ $targetCategory->featured == 1 ? 'checked' : '' }}
                                    >
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Featured</span>
                                </label>
                            </div>
                            @if($targetCategory->image != null)
                                <div>Image</div>
                                <figure class="mt-2" style="width: 80px; height: auto;">
                                    <img src="{{ asset('storage/'.$targetCategory->image) }}" id="categoryImage" class="img-fluid" alt="img">
                                </figure>
                            @endif
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                <label class="custom-file-label" for="image">Choisir une image</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mr-1" type="submit">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection