@extends('layouts.frontend')

@section('title', __('messages.actions'))

@section('content')

<section role="main" class="pl-sm-4 pr-sm-4 mt-1 ">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 
        <ol class="carousel-indicators">
         @foreach( $photos as $photo )
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" data-interval="5000"></li>
         @endforeach
        </ol>
       
        <div class="carousel-inner" role="listbox">
          @foreach( $photos as $photo )
             <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                 <img class="d-block img-fluid mx-auto" src="/storage/{{ $photo->image }}" alt="{{ $photo->title }}">
                    <div class="carousel-caption d-none d-md-block">
                       <h3>{{ $photo->title }}</h3>
                       <p>{{ $photo->descriptoin }}</p>
                    </div>
             </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</section>

@endsection

  
