@extends('layouts.master_post')

@section('content')
    
    <h2>Posts Tagged {{ $tags->tag }}</h2>

    <div class="row">    
        <!-- S:Main -->
        <div class="col-md-8 posts">
            @foreach($tags->posts as $post)
            <!-- Blog Post -->
            <header class="mb-4">
                <a href="{{url('posts')}}/{{$post->id}}" style="text-decoration: none;color:rgb(154 159 15);" id="h"><h1 class="fw-bolder mb-1">{{$post->title}}</h1></a>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at->toDayDateTimeString()}}</div>
                        <!-- Post categories-->
                        @foreach ($post->tags as $tag)
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$tag->tag}}</a>
                        @endforeach
                        
                        
                    </header>
                    <!-- Preview image figure-->
                    <a href="{{url('posts')}}/{{$post->id}}"><figure class="mb-4"><img class="img-fluid rounded" src="../uploads/{{$post->url}}" alt="..." /></figure></a>
                    
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $post->body !!}</p>
                        <div class="panel-footer" style="background-color: #c3bebe">
                            &nbsp;
                        <span class="label label-primary"><i class="fa fa-user"></i>
                            {{$post->user->name}}
                        </span>
                    </div>
                
                    </section><hr style="width: 100%;border:1px solid rgb(0 253 255)"/>
            @endforeach
        </div>
        <!-- E:Main -->

       
    </div>



@endsection