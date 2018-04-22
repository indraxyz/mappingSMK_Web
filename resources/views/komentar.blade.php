@extends('template')

@section('page_title')
	{{'
		Komentar
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
	<div class="ui segment">
    <div class="ui top attached label">
        <h4><i class="user icon"></i> Comments</h4>
    </div>
    <!-- tabel menu -->
    <div class="ui text menu">
		  <div class="ui right dropdown item">
		    <!-- Action -->
		    <i class="bookmark icon"></i>
		    <div class="menu">
		      <div class="item btn mDeleteKomentar"><i class="remove user icon"></i> delete selected</div>
		    </div>
		  </div>
		</div>
        <table class="ui celled padded table" style="">
            <thead>
            <tr>
        	    <th>
	               <div class="ui master checkbox checkboxoKomentar">
	               		<input type="checkbox" tabindex="0" class="hidden" id="cbKomentarMaster">
	               </div>
        	    </th>
              <th>No.</th>
              <th>User</th>
              <th>Sekolah</th>
              <th>Waktu</th>
              <th>Comment</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbKomentar">
              
            </tbody>
        </table>
        
    </div>

    <!-- modal delete User -->
    <div class="ui modal deleteKomentar">
      <i class="close icon"></i>
	  <div class="header">Delete Data</div>
	  <div class="content">
	    <p>Are you sure to delete this Data ?</p>
	  </div>
	  <div class="actions">
	    <div class="ui cancel button">Cancel</div>
	   	<div class="ui brown button deleteKomentar" data-id="">Delete</div>
	  </div>
	</div>
	
@endsection