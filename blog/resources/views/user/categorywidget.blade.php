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