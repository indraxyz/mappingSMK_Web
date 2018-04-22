@extends('template')

@section('page_title')
	{{'
		Manage Admin
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label">
            <h4><i class="spy icon"></i> Admin Accounts</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
		  <div class="ui right dropdown item">
		    <!-- Action -->
		    <i class="bookmark icon"></i>
		    <div class="menu">
		      <div class="item btn addAdmin" data-aksiceadmin='0'><i class="add user icon"></i> create new</div>
		      <div class="item btn mDeleteAdmin"><i class="remove user icon"></i> delete selected</div>
		    </div>
		  </div>
		</div>
        <table class="ui celled padded table" style="">
            <thead>
            <tr>
        	   <th>
	               <div class="ui master checkbox checkboxAdmin">
	               		<input type="checkbox" tabindex="0" class="hidden" id="cbAdminMaster">
	               </div>
        	   </th>
              <th>No.</th>
              <th>Username</th>
              <th>Password</th>
              <th>Email</th>
              <th>Akses</th>
              <th>Last Login</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbAdmin">

            </tbody>
        </table>
        
    </div>

	<!-- modal form create/ edit -->
	<div class="ui modal ceAdmin">
      <i class="close icon ceAdmin"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Admin Form</center></div>
                  <form class="ui form ceAdmin" >
                      <input type="hidden" value="" name="key" id="keyAdmin">
                      <div class="field">
                          <label>Username</label>
                          <input type="text" name="username" id="username" placeholder="Username">
                      </div>
                      <div class="field">
                          <label>Password</label>
                          <input type="text" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="email" placeholder="Email">
                      </div>
                      <div class="field">
                        <label>Pilih Akses</label>
                        <select class="ui dropdown akses" name="akses" id="akses">
                          <option value="">...</option>
                          <option value="1">Master Admin</option>
                          <option value="0">Guest Admin</option>
                        </select>
                      </div>  

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button ceAdmin">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui brown button saveAdmin">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

	<!-- modal detail admin -->
	<div class="ui long modal detailAdmin">
      <i class="close icon detailAdmin"></i>
      <div class="header">
        Detail Admin
      </div>
      <div class="image content">
        <div class="description">
            <div class="ui list">
              <div class="item">
                <div class="header">Username</div>
                <i class="dAdminUsername"></i>
              </div>
              <div class="item">
                <div class="header">Password</div>
                <i class="dAdminPassword"></i>
              </div>
              <div class="item">
                <div class="header">Email</div>
                <i class="dAdminEmail"></i>
              </div>
              <div class="item">
                <div class="header">Akses</div>
                <i class="dAdminAkses"></i>
              </div>
              <div class="item">
                <div class="header">Created</div>
                <i class="dAdminCreated"></i>
              </div>
              <div class="item">
                <div class="header">Updated</div>
                <i class="dAdminUpdated"></i>
              </div>
              <div class="item">
                <div class="header">Last Login</div>
                <i class="dAdminLastLogin"></i>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- modal delete admin -->
    <div class="ui modal deleteAdmin">
      <i class="close icon"></i>
	  <div class="header">Delete Data Admin</div>
	  <div class="content">
	    <p>Are you sure to delete this admin ?</p>
	  </div>
	  <div class="actions">
	    <div class="ui cancel button">Cancel</div>
	   	<div class="ui brown button deleteAdmin" data-username="">Delete</div>
	  </div>
	</div>
	
@endsection