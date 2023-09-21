@extends('frontend.layout.welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <div class="blue  text-decoration-underline">
                    <h5><strong> गोपनियता नीति </strong></h5>
                </div>
                <div class="accordion" id="policy">
                    @foreach ($policy as $pl)
                        <div class="card">
                            <div class="card-header" id="question{{ $pl->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#answer{{ $pl->id }}" aria-expanded="true"
                                        aria-controls="answer{{ $pl->id }}">
                                        {{ $loop->iteration }}. {{ $pl->title }}
                                    </button>
                                </h2>
                            </div>
                            <div id="answer{{ $pl->id }}" class="collapse"
                                aria-labelledby="question{{ $pl->id }}" data-bs-parent="#policy">
                                <div class="card-body">
                                    {{ $pl->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
