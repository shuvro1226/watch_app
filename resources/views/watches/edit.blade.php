@extends('master')

@section('content')

<div class="edit-watch-wrapper mt-2">
    <div class="row">
        <div class="col-6">
            <h1><i class="fas fa-edit"></i> Edit Watch</h1>
        </div>
        <div class="col-6 mt-3">
            <a href="{{route('watch.urlslug', $watch->url_slug)}}" class="btn btn-info float-right ml-2" title="View watch details"><i class="fas fa-eye"></i></a>
            <form id="{{$watch->id}}" method="post" class="d-inline-block float-right" action="{{route('watches.destroy', $watch->id)}}">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-danger form-delete-btn" data-id="{{$watch->id}}" title="Delete watch" data-toggle="modal" data-target="#deleteWatchModal"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
    <hr>
    <small id="requiredHelpBlock" class="form-text text-muted">
        You must fill/select all fields marked with an (<i class="fas fa-asterisk required-field"></i>)
    </small>
    @if($errors->all())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success mt-3">
            {{session()->get('message')}}
        </div>
    @endif

    <form id="watch_edit_form" class="mt-3" action="{{route('watches.update', $watch->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="brand_id">Brands</label> <i class="fas fa-asterisk required-field"></i>
                    <?php $brand_id = Input::old('brand_id') ? Input::old('brand_id') : $watch->brand_id; ?>
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{($brand->id === (int)$brand_id) ? 'selected':''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="model">Model</label> <i class="fas fa-asterisk required-field"></i>
                    @php($model = Input::old('model') ? Input::old('model') : $watch->model)
                    <input type="text" class="form-control" name="model" id="model" value="{{$model}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="case_size">Case Size</label> <i class="fas fa-asterisk required-field"></i>
                    <div class="input-group mb-2">
                        @php($case_size = Input::old('case_size') ? Input::old('case_size') : $watch->case_size)
                        <input type="text" class="form-control" name="case_size" id="case_size" value="{{$case_size}}" />
                        <div class="input-group-append">
                            <div class="input-group-text">mm</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="case_material_id">Case Material</label> <i class="fas fa-asterisk required-field"></i>
                    @php($case_material_id = Input::old('case_material_id') ? Input::old('case_material_id') : $watch->case_material_id)
                    <select name="case_material_id" id="case_material_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($case_materials as $case_material)
                            <option value="{{$case_material->id}}" {{($case_material->id === (int)$case_material_id) ? 'selected':''}}>{{$case_material->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="bracelet">Bracelet</label> <i class="fas fa-asterisk required-field"></i>
                    @php($bracelet = Input::old('bracelet') ? Input::old('bracelet') : $watch->bracelet)
                    <input type="text" class="form-control" name="bracelet" id="bracelet" value="{{$bracelet}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="year">Year</label>
                    @php($year = Input::old('year') ? Input::old('year') : $watch->year)
                    <input type="text" class="form-control" name="year" id="year" value="{{$year}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="price">Price</label> <i class="fas fa-asterisk required-field"></i>
                    <small id="passwordHelpInline" class="text-muted">
                        Accepted format (3333.33)
                    </small>
                    <div class="input-group mb-2">
                        @php($price = Input::old('price') ? Input::old('price') : $watch->price)
                        <input type="text" class="form-control" name="price" id="price" value="{{$price}}" />
                        <div class="input-group-append">
                            <div class="input-group-text">&euro;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="condition_id">Condition</label> <i class="fas fa-asterisk required-field"></i>
                    @php($condition_id = Input::old('condition_id') ? Input::old('condition_id') : $watch->condition_id)
                    <select name="condition_id" id="condition_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($conditions as $condition)
                            <option value="{{$condition->id}}" {{($condition->id === (int)$condition_id) ? 'selected':''}}>{{$condition->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="functionalities">Functions</label>
                    <span class="cancel-selection float-right mr-2" title="Clear selections"><i class="fas fa-times"></i></span>
                    @php($functions = Input::old('functionalities') ? Input::old('functionalities') : array_column(json_decode($watch->functionalities, TRUE), 'id'))
                    <select multiple name="functionalities[]" id="functionalities" class="form-control">
                        @foreach($functionalities as $functionality)
                            <option value="{{$functionality->id}}" {{(in_array($functionality->id, $functions)) ? 'selected':''}}>{{$functionality->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="form-group images-group">
                    <label for="images">Images</label> <i class="fas fa-asterisk required-field"></i>
                    @php($images = Input::old('images') ? Input::old('images') : json_decode($watch->images, TRUE))
                    <span class="btn btn-primary add-image float-right"><i class="fas fa-plus" title="Add another image"></i></span>
                    @foreach($images as $i => $image_url)
                        <div class="row url-block">
                            <div class="col-12">
                                <div class="input-group">
                                    <input type="url" class="form-control image-url" name="images[]" value="{{$image_url}}" />
                                    <span class="input-group-btn">
                                        <span class="btn btn-danger float-right{{$i !== 0 ? ' remove-image' : ' disabled'}}"><i class="fas fa-times"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <small id="imagesHelpBlock" class="form-text text-muted">
                    You can not enter more than 6 urls. Minimum 1 url is required.
                </small>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary float-right"><i class="fas fa-pencil-alt"></i> Update</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        var edit_container = $('#watch_edit_form');
        $(document).ready(function () {
            edit_container.on('click', '.add-image', function () {
                var imageCount = $('.image-url').length;
                var emptyURL = false;
                $('.image-url').each(function () {
                    if($(this).val() === '') {
                        alert('Please fill up the blank url fields');
                        emptyURL = true;
                        return false;
                    }
                });
                if(imageCount < 6 && !emptyURL) {
                    var html = '<div class="row url-block">' +
                        '<div class="col-12">' +
                        '<div class="input-group">' +
                        '<input type="url" class="form-control image-url" name="images[]" />' +
                        '<span class="input-group-btn">' +
                        '<span class="btn btn-danger remove-image pull-right"><i class="fas fa-times"></i></span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('.images-group').append(html);
                }
            });

            edit_container.on('click', '.remove-image', function () {
                $(this).closest('.url-block').remove();
            });
        });
    </script>
</div>

@endsection