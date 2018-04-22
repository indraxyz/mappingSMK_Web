@extends('template')

@section('page_title')
	{{'
		Manage User
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
	<div class="ui segment">
    <div class="ui top attached label">
        <h4><i class="user icon"></i> User Accounts</h4>
    </div>
    <!-- tabel menu -->
    <div class="ui text menu">
		  <div class="ui right dropdown item">
		    <!-- Action -->
		    <i class="bookmark icon"></i>
		    <div class="menu">
		      <div class="item btn mDeleteUser"><i class="remove user icon"></i> delete selected</div>
		    </div>
		  </div>
		</div>
        <table class="ui celled padded table" style="">
            <thead>
            <tr>
        	    <th>
	               <div class="ui master checkbox checkboxUser">
	               		<input type="checkbox" tabindex="0" class="hidden" id="cbUserMaster">
	               </div>
        	    </th>
              <th>No.</th>
              <th>ID</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Pekerjaan</th>
              <th>Last Login</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbUser">

            </tbody>
        </table>
        
    </div>

	<!-- modal form edit -->
	<div class="ui modal eUser">
      <i class="close icon eUser"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Admin Form</center></div>
                  <form class="ui form eUser" >
                      <input type="hidden" value="" name="key" id="keyUser">
                      <div class="field">
                          <label>ID</label>
                          <input type="text" name="id" id="idUser" placeholder="Id">
                      </div>
                      <div class="field">
                          <label>Password</label>
                          <input type="text" name="password" id="passwordUser" placeholder="Password">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="emailUser" placeholder="Email">
                      </div>
                      <div class="field">
                          <label>Nama</label>
                          <input type="text" name="nama" id="namaUser" placeholder="Nama">
                      </div>
                      <div class="field">
                          <label>NIK</label>
                          <input type="number" name="nik" id="nikUser" placeholder="NIK">
                      </div>
                      <div class="field">
                          <label>Tempat Lahir</label>
                          <input type="text" name="tempat_lahir" id="tempatLahirUser" placeholder="Tempat Lahir">
                      </div>
                      <div class="field">
                          <label>Tanggal Lahir</label>
                          <input type="date" name="tgl_lahir" id="tglLahirUser" placeholder="Tanggal Lahir">
                      </div>
                      <div class="field">
                        <label>Jenis Kelamin</label>
                        <select class="ui dropdown kelamin" name="kelamin" id="kelaminUser">
                          <option value="">...</option>
                          <option value="1">Pria</option>
                          <option value="0">Wanita</option>
                        </select>
                      </div>  
                      <div class="field">
                          <label>Pekerjaan</label>
                          <input type="text" name="pekerjaan" id="pekerjaanUser" placeholder="Pekerjaan">
                      </div>
                      <div class="field">
                          <label>Alamat Lengkap</label>
                          <input type="text" name="alamat_lengkap" id="alamatLengkapUser" placeholder="Tanggal Lahir">
                      </div>
                      <div class="field">
                          <label>Tlp.</label>
                          <input type="number" name="tlp" id="tlpUser" placeholder="Nomor Telepon">
                      </div>

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button eUser">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui brown button saveUser">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

	<!-- modal detail User -->
	<div class="ui long modal detailUser">
      <i class="close icon detailUser"></i>
      <div class="header">
        Detail User
      </div>
      <div class="image content">
        <div class="description">
            <div class="ui list">
              <div class="item">
                <div class="header">ID</div>
                <i class="dUserId"></i>
              </div>
              <div class="item">
                <div class="header">Password</div>
                <i class="dUserPassword"></i>
              </div>
              <div class="item">
                <div class="header">Email</div>
                <i class="dUserEmail"></i>
              </div>
              <div class="item">
                <div class="header">Nama</div>
                <i class="dUserNama"></i>
              </div>
              <div class="item">
                <div class="header">NIK</div>
                <i class="dUserNik"></i>
              </div>
              <div class="item">
                <div class="header">Tempat Lahir</div>
                <i class="dUserTempatLahir"></i>
              </div>
              <div class="item">
                <div class="header">Tanggal Lahir</div>
                <i class="dUserTglLahir"></i>
              </div>
              <div class="item">
                <div class="header">Kelamin</div>
                <i class="dUserKelamin"></i>
              </div>
              <div class="item">
                <div class="header">Pekerjaan</div>
                <i class="dUserPekerjaan"></i>
              </div>
              <div class="item">
                <div class="header">alamat</div>
                <i class="dUserAlamat"></i>
              </div>
              <div class="item">
                <div class="header">tlp</div>
                <i class="dUserTlp"></i>
              </div>
              <div class="item">
                <div class="header">Last Login</div>
                <i class="dUserLastLogin"></i>
              </div>
              <div class="item">
                <div class="header">Created</div>
                <i class="dUserCreated"></i>
              </div>
              <div class="item">
                <div class="header">Updated</div>
                <i class="dUserUpdated"></i>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- modal delete User -->
    <div class="ui modal deleteUser">
      <i class="close icon"></i>
	  <div class="header">Delete Data User</div>
	  <div class="content">
	    <p>Are you sure to delete this User ?</p>
	  </div>
	  <div class="actions">
	    <div class="ui cancel button">Cancel</div>
	   	<div class="ui brown button deleteUser" data-username="">Delete</div>
	  </div>
	</div>
	
@endsection