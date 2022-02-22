<style>
    /* .arrow{display: none;} */
    #cat_add{display: none;}
 </style>
<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    {{-- <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
            </div>
        </div>
    </div> --}}
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="">
                    <ul class="list-unstyled mb-0">
                        <li>
                            @foreach ($tags as $tag)
                            <a href="{{route('tags.show',$tag->id)}}">
                                
                                    {{$tag->tag}}
                                
                            </a> &nbsp;
                            @endforeach
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">
            
             <button class="btn btn-primary cbtn" style="font-style: oblique;font-weight:bold">
                Add Category
             </button>
            

        </div>
        <div class="card-body">
            <form method="post" action="{{route('tags')}}" id="cat_add" enctype="multipart/form-data">
                @csrf
                <label for="category">Category</label>
                <input type="text" class="form-control" name="tag"><br>
                <input type="submit" name="submit" value="add" class="btn btn-secondary submit" style="float: right">
            </form>
        </div>
        
    </div>
</div>
<a href="#up" class="arrow"><img src="{{asset('assets/Arrow.png')}}" style="float: right;margin-right:-80px;margin-top:-106px"></a>