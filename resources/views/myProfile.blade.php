@extends('template')

@section('page_title')
	{{'
		My Profile Admin
	'}}
@endsection

@section('page_content')
	<div class="ui relaxed divided list">
	  <div class="item">
	    <i class="large user middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Username</a>
	      <div class="description vUsername">{{$username}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large unlock alternate middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Password</a>
	      <div class="description vPassword">{{$password}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large mail middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Email</a>
	      <div class="description vEmail">{{$email}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large wait middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Last Login</a>
	      <div class="description vLastLogin">{{$last_login}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large wait middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Created</a>
	      <div class="description vCreated">{{$created_at}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large wait middle aligned icon"></i>
	    <div class="content">
	      <a class="header">Updated</a>
	      <div class="description vUpdated">{{$updated_at}}</div>
	    </div>
	  </div>
	  	<button class="small ui right labeled icon brown button editMyAccount" data-username="{{$username}}">
		  <i class="right arrow icon"></i>
		  Edit
		</button>
	</div>

	<!-- modal form edit -->
	<div class="ui modal myProfile">
	  <i class="close icon"></i>
	  <div class="header">
	    Edit My Profile
	  </div>
	  <div class="content">
	    <div class="description">
	      	<form class="ui form myProfile">
	      		<input type="hidden" name="key" class="fKeyMyProfile">
			  <div class="field">
			    <label>Username</label>
			    <input type="text" name="username" class="fUsername">
			  </div>
			  <div class="field">
			    <label>Password</label>
			    <input type="text" name="password" class="fPassword">
			  </div>
			  <div class="field">
			    <label>Email</label>
			    <input type="text" name="email" class="fEmail">
			  </div>
			  <div class="actions">
			    <div class="ui cancel button">Cancel</div>
			    <button class="ui brown button updateMyProfile" type="submit">Submit</button>
			  </div>
			</form>
	    </div>
	  </div>
	</div>
@endsection