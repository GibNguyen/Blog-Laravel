@extends('layouts.user')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at }} by {{ $post->author }}
                        </div>
                        <!-- Post categories-->
                        @foreach ($category as $category)
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $category->name }}
                            </a>
                        @endforeach
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" width="100%" height="400px"
                            src="{{ asset('upload/image/' . $post->image) }}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {!! $post->content !!}
                    </section>
                </article>
                <!-- Comments section-->
                @if (Auth::check())
                    <div class="post-comments">
                        <header>
                            <h3 class="h6">Post Comments<span class="no-of-comments">({{ count($commentList) }})</span></h3>
                        </header>
                        @foreach ($commentList as $comment)
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="{{ asset('user\img\user.svg') }}" alt="..."
                                                class="img-fluid rounded-circle" /></div>
                                        <div class="title"><strong>{{ $comment->user->name }}</strong><span
                                                class="date">{{ $comment->created_at }}</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pagination-->
                        {{-- <div class='d-flex justify-content-center'>
                            {!! $postList->links() !!}
                        </div> --}}



                    </div>
                    <div class="add-comment">
                        <header>
                            <h3 class="h6">Leave a reply</h3>
                        </header>
                        <form action="" class="commenting-form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea placeholder="Type your comment" name='comment' class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12 mt-5">
                                    <button type="submit" class="btn btn-secondary">Submit Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <form action="{{ route('search') }}" method="get">

                        <div class="card mb-4">
                            <div class="card-header">Search</div>
                            <div class="card-body">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Enter search term..."
                                        aria-label="Enter search term..." aria-describedby="button-search" name='search' />
                                    <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row ">
                            @foreach ($categoryList as $category)
                                @if ($loop->odd)
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><a class="text-uppercase"
                                                    href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                                        </ul>
                                    </div>
                                @endif
                            @endforeach

                            @foreach ($categoryList as $category)
                                @if ($loop->even)
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><a class="text-uppercase"
                                                    href="/category/{{ $category->id }}">{{ $category->name }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
        </div>
    </div>
    </div>
@endsection
