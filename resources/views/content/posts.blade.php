<style>
    #h:hover{color:red}
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@extends('layouts.master')
{{-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css"> --}}
<link rel="canonical" href="https://www.codecademy.com/learn/learn-bootstrap">
@section('content')
<div style="">
<a href="#d" style="float: right"><button class="btn btn-primary" style="font-style: oblique;font-weight:bold">Add Post</button></a>
</div> 
<!-- Post content-->
 <article>
    <div style='color:red'>
        @foreach ($errors->all() as $error)
          {{$error}} <br>
        @endforeach          
    </div>
     
    <!-- Post header-->
    <header class="mb-4">
        <!-- Post title-->
        @foreach ($posts as $post)
            
        
        <a href="{{url('posts')}}/{{$post->id}}" style="text-decoration: none;color:rgb(154 159 15);" id="h"><h1 class="fw-bolder mb-1">{{$post->title}}</h1></a>
        <!-- Post meta content-->
        <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at->toDayDateTimeString()}}</div>
        <!-- Post categories-->
        @foreach ($post->tags as $tag)
        <p class="badge bg-secondary text-decoration-none link-light">{{$tag->tag}}</p>
        @endforeach
        
        
    </header>
    <!-- Preview image figure-->
    <a href="{{url('posts')}}/{{$post->id}}"><figure class="mb-4"><img class="img-fluid rounded" src="uploads/{{$post->url}}" alt="..." /></figure></a>
    
    <!-- Post content-->
    <section class="mb-5">
        <p class="fs-5 mb-4">{!! $post->body !!}</p>
        <div class="panel-footer" style="background-color: #c3bebe">
            &nbsp;
        <span class="label label-primary"><i class="fa fa-user"></i>
            {{$post->user->name}}
        </span>
    </div>
        {{-- <button class="btn btn-secondary" data-toggle="modal" data-target="#post_edit"
        data-post_id = '{{$post->id}}' data-post_title = '{{$post->title}}' data-post_body = '{{$post->body}}'
         data-post_url = '{{$post->url}}'>Edit</button> --}}
    </section><hr style="width: 100%;border:1px solid rgb(0 253 255)"/>
    @endforeach
    <section class="mb-5">
        <form role="form" method="POST" action="posts" enctype="multipart/form-data" id="d">
            <fieldset style="border: 1px solid black;padding:10px">
                <legend>Adding Post:</legend>
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label">Title:</label>
                <div>
                    <input type="text" class="form-control input-lg" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Body:</label>
                <div>
                    <textarea name="body" class="form-control" style="height: 300px"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Categories:</label>
                <div>
                    <select name="tag[]" class="form-control tags" multiple style="color: black;font-weight:bold">
                        @foreach ($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="form-label">File:</label>
                <input class="form-control form-control-sm" id="url" type="file" name="url"
                accept=".pdf,.jpg, .png, image/jpeg, image/png" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary">
            </div>
        </fieldset>
        </form>
    </section>
</article>
    
</section>

{{-- <div class="modal fade" id="post_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editing post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="" enctype="multipart/form-data">
                <fieldset style="border: 1px solid black;padding:10px">
                    <legend>Edit Post:</legend>
                {{ csrf_field() }}
                <input type="text" name="id" id="post_id">
                <div class="form-group">
                    <label class="control-label">Title:</label>
                    <div>
                        <input type="text" class="form-control input-lg" name="title" id="post_title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Body:</label>
                    <div>
                        <textarea name="body" class="form-control" style="height: 300px" id="post_body"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="form-label">File:</label>
                    <input class="form-control form-control-sm" id="url" type="file" name="url"
                    accept=".pdf,.jpg, .png, image/jpeg, image/png" />
                </div>
            </fieldset>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div> --}}
  @endsection

  @section('js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    // $('#post_edit').on('show.bs.modal' , function(event){
    //     var button = $(event.relatedTarget);
    //     var post_id = button.data('post_id')
    //     var post_title = button.data('post_title')
    //     var post_body = button.data('post_body')
    //     var post_url = button.data('post_url')

    //     var modal = $(this)
    //     modal.find('.modal-body #post_id').val(post_id);
    //     modal.find('.modal-body #post_title').val(post_title);
    //     modal.find('.modal-body #post_body').val(post_body);
    //     modal.find('.modal-body #url').val(post_url);

    // })

    $(document).ready(function() {
    $('.tags').select2();

    $(".cbtn").click(function(){
        $("#cat_add").show();
     });
     $('.submit').click(function(){
         $("#cat_add").hide();
     })
});

</script>
@endsection



