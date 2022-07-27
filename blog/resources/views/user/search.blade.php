@extends('layouts.user')

@section('content')
    <div class="row mt-4">

        <!-- Blog entries-->
        <h3>Search Result: {{ $key }} </h3>
        @if ($postList->count() == 0)
            <div class="alert alert-danger text-center">
                Data does not exist
            </div>
        @endif
        <!-- Featured blog post-->
        <!-- Nested row for non-featured blog posts-->
    </div>
    <div class="row">
        <div class="col-lg-8">

            <div class="row ">
                <div class="col-lg-6">
                    @foreach ($postList as $post)
                        <!-- Blog post-->
                        @if ($loop->odd)
                            <div class="card mb-4">
                                <a href="{{ route('detail', $post->id) }}"><img class="card-img-top"
                                        src="{{ asset('upload/image/' . $post->image) }}" alt="..." width="100%"
                                        height="200px" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created_at }}</div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ strip_tags($post->content) }}</p>
                                    <a class="btn btn-primary" href="{{ route('detail', $post->id) }}">Read more →</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>






                <div class="col-lg-6">
                    @foreach ($postList as $post)
                        @if ($loop->even)
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{ route('detail', $post->id) }}"><img class="card-img-top"
                                        src="{{ asset('upload/image/' . $post->image) }}" alt="..." width="100%"
                                        height="200px" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created_at }}</div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ strip_tags($post->content) }}</p>
                                    <a class="btn btn-primary" href="{{ route('detail', $post->id) }}">Read more →</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>


            <!-- Pagination-->
            <div class='d-flex justify-content-center'>
                {!! $postList->links() !!}
            </div>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            @include('user.searchwidget')
            <!-- Categories widget-->
            @include('user.categorywidget')
        </div>
    </div>
@endsection
