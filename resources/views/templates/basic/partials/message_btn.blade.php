@if(auth()->check())
<a href="dashboard/inbox">
	<button type="button" class="btn btn-primary message-button" >
	<i class="fa fa-envelope"></i>
</button>
</a>
@else
<a href="{{route('user.login')}}">
	<button type="button" class="btn btn-primary message-button" data-toggle="modal" data-target="#composeModal">
	<i class="fa fa-envelope"></i>
</button>
</a>
@endif


<style type="text/css">
	.message-button{
		position: fixed;;
		bottom: 20px;
		right: 20px;
		z-index: 1000
	}
</style>