@extends('layouts.user')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('d/m/Y') }} by
                        {{ $post->author }}
                    </div>
                    <!-- Post categories-->
                    @foreach ($category as $category)
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $category->name }}
                        </a>
                    @endforeach
                </header>
        </div>
        <div class="row">
            <div class="col-lg-8">

                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" width="100%" height="400px"
                        src="{{ asset('upload/image/' . $post->image) }}" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    {!! $post->content !!}
                </section>
                </article>
                <!-- Comments section-->
                <div class="post-comments">
                    <header>
                        <h3 class="h6">Post Comments<span class="no-of-comments">({{ count($allComments) }})</span>
                        </h3>
                    </header>
                    @foreach ($commentList as $comment)
                        <div class="comment">
                            <div class="comment-header d-flex justify-content-between">
                                <div class="user d-flex align-items-center">
                                    <div class="image"><img src="{{ asset('user\img\user.svg') }}" alt="..."
                                            class="img-fluid rounded-circle" /></div>
                                    <div class="title"><strong>{{ $comment->user->name }}</strong><span
                                            class="date">{{ $comment->created_at->format('d/m/Y') }}</span></div>
                                </div>
                            </div>
                            <div class="comment-body d-flex justify-content-between">
                                <p>{{ $comment->content }}</p>
                                @if (Auth::check())
                                    @if (Auth::user()->id == $comment->user->id || Auth::user()->role->id == 1)
                                        <a onclick="return confirm('Are you sure you want to delete this comment?')"
                                            href="{{ route('deleteComment', $comment->id) }}"
                                            class="btn btn-danger  ">Delete</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <!-- Pagination-->
                    <div class='d-flex justify-content-center'>
                        {!! $commentList->links() !!}
                    </div>
                </div>
                @if (Auth::check())
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
                @else
                    <h4 style="color: red">You need to log in to write comment</h4>
                @endif
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                @include('user.searchwidget')
                <!-- Categories widget-->
                @include('user.categorywidget')
            </div>
            <!-- Side widget-->
        </div>
    </div>
    </div>
@endsection
