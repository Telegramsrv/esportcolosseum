@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<section>
			<div class="section-title">Latest <span>Blogs</span></div>
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
			              	<div class="card-reveal blue-grey darken-4 blog">
				                <span class="card-title white-text text-darken-4">
				                	Blog Title<i class="material-icons right">close</i>
				                </span>
			                	{!! str_limit($blog->description, 200) !!}
			              	</div>
			            </div>
			        </div>
				@endforeach
			</div>
			{{ $blogs->links('user.partials.pagination') }}
		    <hr/>
		</section>
	</div>	
@endsection