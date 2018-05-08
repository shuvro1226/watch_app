@extends('master')

@section('content')

<div class="create-watch-wrapper mt-2">
    <h1><i class="fas fa-plus-square"></i> Add New Watch</h1>
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

    <form id="watch_create_form" class="mt-3" action="{{route('watches.store')}}" method="post">
        @csrf
        <div class="form-row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="brand_id">Brands</label> <i class="fas fa-asterisk required-field"></i>
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{(collect(Input::old('brand_id'))->contains($brand->id)) ? 'selected':''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="model">Model</label> <i class="fas fa-asterisk required-field"></i>
                    <input type="text" class="form-control" name="model" id="model" value="{{Input::old('model')}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="case_size">Case Size</label> <i class="fas fa-asterisk required-field"></i>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="case_size" id="case_size" value="{{Input::old('case_size')}}" />
                        <div class="input-group-append">
                            <div class="input-group-text">mm</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="case_material_id">Case Material</label> <i class="fas fa-asterisk required-field"></i>
                    <select name="case_material_id" id="case_material_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($case_materials as $case_material)
                            <option value="{{$case_material->id}}" {{(collect(Input::old('case_material_id'))->contains($case_material->id)) ? 'selected':''}}>{{$case_material->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="bracelet">Bracelet</label> <i class="fas fa-asterisk required-field"></i>
                    <input type="text" class="form-control" name="bracelet" id="bracelet" value="{{Input::old('bracelet')}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" name="year" id="year" value="{{Input::old('year')}}" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="price">Price</label> <i class="fas fa-asterisk required-field"></i>
                    <small id="passwordHelpInline" class="text-muted">
                        Accepted format (3333.33)
                    </small>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="price" id="price" value="{{Input::old('price')}}" />
                        <div class="input-group-append">
                            <div class="input-group-text">&euro;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="condition_id">Condition</label> <i class="fas fa-asterisk required-field"></i>
                    <select name="condition_id" id="condition_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($conditions as $condition)
                            <option value="{{$condition->id}}" {{(collect(Input::old('condition_id'))->contains($condition->id)) ? 'selected':''}}>{{$condition->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="functionalities">Functions</label>
                    <span class="cancel-selection float-right mr-2" title="Clear selections"><i class="fas fa-times"></i></span>
                    <select multiple name="functionalities[]" id="functionalities" class="form-control">
                        @foreach($functionalities as $functionality)
                            <option value="{{$functionality->id}}" {{Input::old('functionalities') && in_array($functionality->id, Input::old('functionalities')) ? 'selected':''}}>{{$functionality->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="form-group images-group">
                    <label for="images">Images</label> <i class="fas fa-asterisk required-field"></i>
                    <span class="btn btn-primary add-image float-right"><i class="fas fa-plus" title="Add another image"></i></span>
                    @if(Input::old('images'))
                        @foreach(Input::old('images') as $i => $image_url)
                            <div class="row url-block">
                                <div class="col-12">
                                    <div class="input-group">
                                        <input type="url" class="form-control image-url" name="images[]" value="{{$image_url}}" />
                                        <span class="input-group-btn">
                                            <span class="btn btn-danger float-right{{$i !== 0 ? ' remove-image' : ' disabled'}}"><i class="fas fa-trash"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row url-block">
                            <div class="col-12">
                                <div class="input-group">
                                    <input type="url" class="form-control image-url" name="images[]" />
                                    <span class="input-group-btn">
                                    <span class="btn btn-danger disabled float-right"><i class="fas fa-times"></i></span>
                                </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <small id="imagesHelpBlock" class="form-text text-muted">
                    You can not enter more than 6 urls. Minimum 1 url is required.
                </small>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary float-right"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        var create_container = $('#watch_create_form');
        $(document).ready(function () {
            create_container.on('click', '.add-image', function () {
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
                        '<span class="btn btn-danger remove-image float-right"><i class="fas fa-times"></i></span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('.images-group').append(html);
                }
            });

            create_container.on('click', '.remove-image', function () {
                $(this).closest('.url-block').remove();
            });
        });
    </script>
</div>

@endsection