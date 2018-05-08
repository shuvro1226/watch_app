@extends('master')

@section('content')
     <div class="watch-list-wrapper mt-2">
         <div class="row">
             @foreach($watches as $watch)
                 <div class="col-3">
                     <div class="card border-info">
                         <div class="card-img-top" style="background-image: url('{{json_decode($watch->images)[0]}}')"></div>
                         <div class="card-body text-info">
                             <a class="card-model-name" href="{{route('watch.urlslug', $watch->url_slug)}}">
                                 <h5 class="card-title">{{$watch->model}}</h5>
                             </a>
                             <p class="card-text">
                                 @php($fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY ))
                                 {{$watch->brand->name}}<br>
                                 Year: {{$watch->year}}<br>
                                 Price: {{$fmt->formatCurrency($watch->price, "EUR")}}
                             </p>
                             <a href="{{route('watch.urlslug', $watch->url_slug)}}" class="btn btn-info" title="View watch details"><i class="fas fa-eye"></i></a>
                             <a href="{{route('watches.edit', $watch->id)}}" class="btn btn-primary" title="Update watch"><i class="fas fa-edit"></i></a>
                             <form id="{{$watch->id}}" method="post" class="d-inline-block" action="{{route('watches.destroy', $watch->id)}}">
                                 @csrf
                                 @method('delete')
                                 <button type="button" class="btn btn-danger form-delete-btn" data-id="{{$watch->id}}" title="Delete watch" data-toggle="modal" data-target="#deleteWatchModal"><i class="fas fa-trash-alt"></i></button>
                             </form>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
         {{($watches->links())}}
     </div>
@endsection