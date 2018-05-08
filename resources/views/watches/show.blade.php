@extends('master')

@section('content')
    <h1 class="mt-3"><i class="fas fa-clock"></i> {{$watch->brand->name}} - {{$watch->model}}</h1>
    <hr>
    <div class="row mt-3">
        <div class="col-6">
            <div id="watch_slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @foreach(json_decode($watch->images) as $i => $image)
                        <li data-target="#watch_slider" data-slide-to="{{$i}}" class="{{$i === 0 ? 'active':''}}"></li>
                    @endforeach
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    @foreach(json_decode($watch->images) as $i => $image)
                        <div class="carousel-item {{$i === 0 ? 'active':''}}">
                            <div class="carousel-content" style="background-image: url('{{$image}}')"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#watch_slider" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#watch_slider" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>

            @if(!empty($watch->functionalities))
            <div class="card mt-3">
                <div class="card-header">
                    <i class="fas fa-child"></i> Functions
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($watch->functionalities as $functions)
                        <li class="list-group-item">{{$functions->name}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="col-6">
            <ul class="list-group">
                <li class="list-group-item"><b><i class="fab fa-bandcamp"></i> Brand:</b> {{$watch->brand->name}}</li>
                <li class="list-group-item"><b><i class="fab fa-buromobelexperte"></i> Model:</b> {{$watch->model}}</li>
                <li class="list-group-item"><b><i class="fas fa-suitcase"></i> Case Size:</b> {{$watch->case_size}}mm</li>
                <li class="list-group-item"><b><i class="fas fa-briefcase"></i> Case Material:</b> {{$watch->caseMaterial->name}}</li>
                <li class="list-group-item"><b><i class="fas fa-link"></i> Bracelet:</b> {{$watch->bracelet}}</li>
                <li class="list-group-item"><b><i class="far fa-calendar-alt"></i> Year:</b> {{$watch->year}}</li>
                @php($fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY ))
                <li class="list-group-item"><b><i class="fas fa-euro-sign"></i> Price:</b> {{$fmt->formatCurrency($watch->price, "EUR")}}</li>
                <li class="list-group-item"><b><i class="fas fa-sun"></i> Condition:</b> {{$watch->condition->name}}</li>
                <li class="list-group-item"><b><i class="fab fa-font-awesome"></i> Reference:</b> {{$watch->sku}}</li>
            </ul>
            <a href="{{route('watches.edit', $watch->id)}}" class="btn btn-primary float-right mt-3 ml-2" title="Update watch"><i class="fas fa-edit"></i> Edit</a>
            <form id="{{$watch->id}}" class="mt-3" method="post" action="{{route('watches.destroy', $watch->id)}}">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-danger form-delete-btn float-right" data-id="{{$watch->id}}" title="Delete watch" data-toggle="modal" data-target="#deleteWatchModal"><i class="fas fa-trash-alt"></i> Delete</button>
            </form>
        </div>
    </div>
@endsection