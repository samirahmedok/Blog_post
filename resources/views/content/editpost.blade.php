@extends('layouts.master')

@section('content')

<form role="form" method="POST" action="{{route('edit_post')}}" enctype="multipart/form-data" class="edit_form">
    <fieldset style="border: 1px solid black;padding:10px">
        <legend>Edit Post:</legend>
    {{ csrf_field() }}
    <input type="hidden" name="id" id="post_id" value="{{$post->id}}">
    <div class="form-group">
        <label class="control-label">Title:</label>
        <div>
            <input type="text" class="form-control input-lg" name="title" id="post_title" value="{{$post->title}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Body:</label>
        <div>
            <textarea name="body" class="form-control" style="height: 300px" id="post_body" >{{$post->body}}</textarea>
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
        <input class="form-control form-control-sm" value="" id="url" type="file" name="url"
        accept=".pdf,.jpg, .png, image/jpeg, image/png" /><br>
        <img src="{{ asset('uploads/'.$post->url) }}" style="max-width: 200px">
    </div>
    {{-- <div class="form-group">
        <label for="url" class="form-label">File:</label>
        <input class="form-control form-control-sm" id="url" type="file" name="url"
        accept=".pdf,.jpg, .png, image/jpeg, image/png" value="{{$post->url}}" />
    </div> --}}
    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
     <button type="submit" class="btn btn-primary">Save changes</button>
</fieldset>
</form>

@endsection
@section('js')
<script>
    $('document').ready(function(){
        $('.tags').select2().val({!! json_encode($post->tags()->pluck('id')) !!}).trigger('change');
    });
</script>
@endsection