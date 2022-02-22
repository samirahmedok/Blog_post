@extends('layouts.master_post')
<style>
    /* .edit_form{display: none} */
</style>
@section('content')
 <!-- Post content-->
 <article>

 @if (session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Post header-->
    <header class="mb-4">
        <!-- Post title-->
        
        <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
        <!-- Post meta content-->
        <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at}}</div>
        <!-- Post categories-->
        @foreach ($post->tags as $tag)
        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$tag->tag}}</a>
        @endforeach
    </header>

    

    <!-- Preview image figure-->
    
    <figure class="mb-4"><img class="img-fluid rounded" src="../uploads/{{$post->url}}" alt="..." /></figure>
    
    
   
    <!-- Post content-->

    <section class="mb-5">
        <p class="fs-5 mb-4">{{$post->body}}</p>
        <a href="{{url('/')}}" class="btn btn-primary">Back</a>
   
        <a href="{{route('editpost',$post->id)}}"><button class="btn btn-secondary" id="edit_post">Edit</button> </a>
        <a href="{{route('delete_post',$post->id)}}"><button class="btn btn-danger" id="edit_post">Delete</button> </a>
  
       
    </section>

        

</article>
<!-- Comments section-->
<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            <form class="mb-4" method='POST' action="{{ route('comments.store',$post->id) }}">
             {{ csrf_field() }}
                <textarea class="form-control" id="body" name='body' rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
            
               <button class="btn" type="submit" style="border: none;margin-top:5px;float:right"><img src='{{asset('assets/send-button.png')}}' style="width: 30px;height:30px;" ></button> 
                
            </form>
            <!-- Comment with nested comments-->
            @if (Auth::check())
                @foreach ($post->comments as $comment)
            <div class="d-flex mb-4">
                <!-- Parent comment-->

                
                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                
                <div class="ms-3" class="content">
                    
                    <div class="fw-bold " >
                            {{$comment->user_name}}
                         
                    </div>

                    <div>
                        {{$comment->body}}
                    </div>
            
                    
                    
                    {{-- <!-- Child comment 1-->
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">Commenter Name</div>
                            And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                        </div>
                    </div> --}}
                    </div>
            </div>
            @endforeach
            @endif
            

        </div>
    </div>

</section>

@endsection


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

// $(document).ready(function(){
//     // function loaddata(){
//     //     $.ajax({
//     //         url:
//     //         type: 'POST',
//     //         success:function(data){

//     //         }
//     //     });
//     // }
//     // loaddata();
//     $('.btn').on('click',function(e){
//         e.preventDefault();
//         var body = $('#body').val();
//         $.ajax({
//             url:{{ route('comments.store',$post->id) }},
//             type: 'POST',
//             data: {body: body},
//             success:function(data){
//                 $('.content').val();
//             }
//         });
//     });
// });
    
    // $("#edit_post").click(function(){
	// 	 $(".edit_form").show()
	 
	// })
</script>