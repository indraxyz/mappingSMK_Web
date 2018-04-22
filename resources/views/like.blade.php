@extends('template')

@section('page_title')
	{{'
		Like
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
	<div class="ui segment">
	    <div class="ui top attached label">
	        <h4><i class="empty heart icon"></i> Like</h4>
	    </div>
	    
        <table class="ui celled padded table" style="">
            <thead>
	            <tr>
	              <th>No.</th>
	              <th>Sekolah</th>
	              <th>Email</th>
	              <th>Akreditas</th>
	              <th>Likes</th>
	            </tr>
            </thead>
            <tbody id="tbLike">
              
            </tbody>
        </table>
        
    </div>
	
@endsection