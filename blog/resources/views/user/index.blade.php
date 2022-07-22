@extends('layouts.user')

@section('content')
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to My Blog!</h1>
        </div>
    </div>
</header>
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <!-- Nested row for non-featured blog posts-->

            <div class="row ">


                <div class="col-lg-6">
                    @foreach ($postList as $post)
                        <!-- Blog post-->
                        @if ($loop->odd)
                            <div class="card mb-4">
                                <a href="{{ route('detail', $post->id) }}"><img class="card-img-top"
                                        src="{{ asset('upload/image/' . $post->image) }}" alt="..." width="100%" height="200px"/></a>
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
                                        src="{{ asset('upload/image/' . $post->image) }}" alt="..." width="100%" height="200px" /></a>
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
            <form action="{{ route('search') }}" method="get">
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                aria-label="Enter search term..." aria-describedby="button-search" name='search'/>
                            <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>         
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row ">
                        @foreach ($categoryList as $category)
                            @if ($loop->odd)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a class="text-uppercase" href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach

                        @foreach ($categoryList as $category)
                            @if ($loop->even)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a class="text-uppercase" href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Side widget-->
        </div>
    </div>
@endsection
