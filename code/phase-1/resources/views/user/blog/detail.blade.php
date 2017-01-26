@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])

@section('static-content')
	<div class="tab-content col s12 m10">
		<div class="" id="tab_a">
			<div class="section-title"><span>{!! $blog->title !!}</span></div>
			<img src="{!! url(env('UPLOAD_BLOG_BANNER', 'storage/blogs/large/') . $blog->banner_image) !!}" class="responsive-img" alt="{!! $blog->title !!}" />
			<p>
				{!! $blog->description !!}
			</p>	
		</div>
	</div>	
@endsection