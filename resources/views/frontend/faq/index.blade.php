@extends('frontend.layout.welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="blue  text-decoration-underline">
                <h5><strong>  बारम्बार सोधिने प्रश्न </strong></h5>
            </div>
            <div class="accordion" id="faqs">
                @foreach($faqs as $faq)
                <div class="card">
                    <div class="card-header" id="question{{ $faq->id }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#answer{{ $faq->id }}" aria-expanded="true" aria-controls="answer{{ $faq->id }}">
                                {{$loop->iteration}}. {{ $faq->question_ne }}
                            </button>
                        </h2>
                    </div>
                    <div id="answer{{ $faq->id }}" class="collapse" aria-labelledby="question{{ $faq->id }}" data-bs-parent="#faqs">
                        <div class="card-body">
                            {{ $faq->answer_ne }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
