@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])

@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="" id="tab_a">
			<div class="section-title"><span>{!! $page->title !!}</span></div>
			<p>
				{!! $page->description !!}
			</p>	
		</div>
	</div>	
@endsection