@extends('layouts.user.home')

@section('blog-section')
<section>
	<div class="section-title">Latest <span>Blogs</span></div>
		@php($colCounter = 0)
		<div class="row">			
		@foreach ($blogs as $blog)
	        <div class="col s12 m3">
	            <div class="card hoverable">
	              	<div class="card-image waves-effect waves-block waves-light">
	              		<a href="{!! route('blog-detail', ['blogSlug' => $blog->slug])!!}">
	                	<img src="{!! url(env('UPLOAD_BLOG_THUMBNAIL', 'storage/blogs/small/').$blog->display_image) !!}" alt="" class="circle responsive-img">
	                	</a>
	              	</div>
	              	<div class="card-content blue-grey darken-4">
	                	<span class="card-title activator white-text text-darken-4">
	                		{!! $blog->title !!}
	                		<i class="material-icons right">more_vert</i>
	                	</span>
	              	</div>
	              	<div class="card-reveal blue-grey darken-4">
		                <span class="card-title white-text text-darken-4">
		                	Blog Title<i class="material-icons right">close</i>
		                </span>
	                	<p class="grey-text">{!! str_limit($blog->description, 200) !!}</p>
	              	</div>
	            </div>
	        </div>
	        @php
	        	$colCounter++;
	        	if($colCounter%3 == 0){
	        		echo '	</div>
	        				<div class="row">';
	        	}
	        @endphp
		@endforeach
		</div>
	</div>
    <hr/>
</section>
@endsection