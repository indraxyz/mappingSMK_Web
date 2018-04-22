@extends('template')

@section('page_title')
  {{'
    Manage Sekolah
  '}}
@endsection

@section('page_content')
  <!-- tabel -->
  <div class="ui segment">
        <div class="ui top attached label">
            <h4><i class="spy icon"></i> Sekolah Accounts</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
      <div class="ui right dropdown item">
        <!-- Action -->
        <i class="bookmark icon"></i>
        <div class="menu">
          <div class="item btn addSekolah" data-aksice='0'><i class="add user icon"></i> create new</div>
          <div class="item btn mDelSekolah"><i class="remove user icon"></i> delete selected</div>
        </div>
      </div>
    </div>
        <table class="ui celled padded table" style="">
            <thead>
            <tr>
              <th>
                 <div class="ui master checkbox checkboxSekolah">
                    <input type="checkbox" tabindex="0" class="hidden" id="cbSekolahMaster">
                 </div>
              </th>
              <th>No.</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Akreditas</th>
              <th>Web Site</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbSekolah">

            </tbody>
        </table>
        
    </div>

  <!-- modal form create/ edit -->
  <div class="ui modal ceSekolah">
      <i class="close icon ceSekolah"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Create Form</center></div>
                  <form class="ui form ceSekolah" >
                      <input type="hidden" value="" name="key" id="keySekolah">
                      <div class="field">
                          <label>Nama</label>
                          <input type="text" name="nama" id="nama" placeholder="Nama">
                      </div>
                      <div class="field">
                          <label>Alamat</label>
                          <input type="text" name="alamat" id="alamat" placeholder="Alamat">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="email" placeholder="Email">
                      </div>
                      <div class="field">
                          <label>Telepon</label>
                          <input type="number" name="tlp" id="tlp" placeholder="Telepon">
                      </div>
                      <div class="field">
                          <label>Akreditas</label>
                          <input type="text" name="akreditas" id="akreditas" placeholder="Akreditas">
                      </div>
                      <div class="field">
                          <label>Website</label>
                          <input type="text" name="website" id="website" placeholder="Website">
                      </div>
                      <div class="field">
                          <label>Deskripsi</label>
                          <textarea name="deskripsi" id="deskripsi"></textarea>
                      </div>
                      <div class="field">
                          <label>Kepala Sekolah</label>
                          <input type="text" name="kep_sek" id="kep_sek" placeholder="Kepala Sekolah">
                      </div>
                      <div class="field">
                        <label>Status Mutu</label>
                        <select class="ui dropdown status_mutu" name="status_mutu" id="status_mutu">
                          <option value="">...</option>
                          <option value="Negeri">Negeri</option>
                          <option value="Swasta">Swasta</option>
                        </select>
                      </div>  
                      <div class="field">
                          <label>Sertifikasi ISO</label>
                          <input type="text" name="sertifikasi_iso" id="sertifikasi_iso" placeholder="Sertifikasi ISO">
                      </div>
                      <div class="field">
                        <label>Rayon</label>
                        <select class="ui dropdown rayon" name="rayon" id="rayon">
                          <option value="">...</option>
                          <option value="0">Surabaya Barat</option>
                          <option value="1">Surabaya Pusat</option>
                          <option value="2">Surabaya Selatan</option>
                          <option value="3">Surabaya Timur</option>
                          <option value="4">Surabaya Utara</option>
                        </select>
                      </div> 
                      <div class="field">
                          <label>Latitude</label>
                          <input type="text" name="lat" id="lat" placeholder="Latitude">
                      </div>
                      <div class="field">
                          <label>Longitude</label>
                          <input type="text" name="long" id="long" placeholder="Longitude">
                      </div>
                      <div class="field">
                          <label>Foto</label>
                          <input type="file" name="foto" id="foto" placeholder="Foto">
                      </div>

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button ceSekolah">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui brown button saveSekolah">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- form edit -->
  <div class="ui modal eSekolah">
      <i class="close icon eSekolah"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Edit Form</center></div>
                  <form class="ui form eSekolah" >
                      <input type="hidden" value="" name="key" id="keySekolah">
                      <input type="hidden" value="" name="oldFoto" id="oldFoto">
                      <div class="field">
                          <label>Nama</label>
                          <input type="text" name="nama" id="nama" placeholder="Nama">
                      </div>
                      <div class="field">
                          <label>Alamat</label>
                          <input type="text" name="alamat" id="alamat" placeholder="Alamat">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="email" placeholder="Email">
                      </div>
                      <div class="field">
                          <label>Telepon</label>
                          <input type="number" name="tlp" id="tlp" placeholder="Telepon">
                      </div>
                      <div class="field">
                          <label>Akreditas</label>
                          <input type="text" name="akreditas" id="akreditas" placeholder="Akreditas">
                      </div>
                      <div class="field">
                          <label>Website</label>
                          <input type="text" name="website" id="website" placeholder="Website">
                      </div>
                      <div class="field">
                          <label>Deskripsi</label>
                          <textarea name="deskripsi" id="deskripsi"></textarea>
                      </div>
                      <div class="field">
                          <label>Kepala Sekolah</label>
                          <input type="text" name="kep_sek" id="kep_sek" placeholder="Kepala Sekolah">
                      </div>
                      <div class="field">
                        <label>Status Mutu</label>
                        <select class="ui dropdown status_mutu" name="status_mutu" id="status_mutu">
                          <option value="">...</option>
                          <option value="Negeri">Negeri</option>
                          <option value="Swasta">Swasta</option>
                        </select>
                      </div>  
                      <div class="field">
                          <label>Sertifikasi ISO</label>
                          <input type="text" name="sertifikasi_iso" id="sertifikasi_iso" placeholder="Sertifikasi ISO">
                      </div>
                      <div class="field">
                        <label>Rayon</label>
                        <select class="ui dropdown rayon" name="rayon" id="rayon">
                          <option value="">...</option>
                          <option value="0">Surabaya Barat</option>
                          <option value="1">Surabaya Pusat</option>
                          <option value="2">Surabaya Selatan</option>
                          <option value="3">Surabaya Timur</option>
                          <option value="4">Surabaya Utara</option>
                        </select>
                      </div> 
                      <div class="field">
                          <label>Latitude</label>
                          <input type="text" name="lat" id="lat" placeholder="Latitude">
                      </div>
                      <div class="field">
                          <label>Longitude</label>
                          <input type="text" name="long" id="long" placeholder="Longitude">
                      </div>
                      <div class="field">
                          <label>Foto</label>
                          <input type="file" name="foto" id="foto" placeholder="Foto">
                      </div>

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button eSekolah">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui brown button updateSekolah">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- modal detail -->
  <div class="ui long modal detailSekolah">
      <i class="close icon"></i>
      <div class="header">
        Detail Sekolah
      </div>
      <div class="content">
        <div class="description">
            <img class="ui centered medium rounded image dFoto" src="">
            <div class="ui list">
              <div class="item">
                <div class="header">Nama</div>
                <i class="dNama"></i>
              </div>
              <div class="item">
                <div class="header">Alamat</div>
                <i class="dAlamat"></i>
              </div>
              <div class="item">
                <div class="header">Email</div>
                <i class="dEmail"></i>
              </div>
              <div class="item">
                <div class="header">Tlp.</div>
                <i class="dTlp"></i>
              </div>
              <div class="item">
                <div class="header">Akreditas</div>
                <i class="dAkreditas"></i>
              </div>
              <div class="item">
                <div class="header">Website</div>
                <i class="dWebsite"></i>
              </div>
              <div class="item">
                <div class="header">Kepala Sekolah</div>
                <i class="dKepSek"></i>
              </div>
              <div class="item">
                <div class="header">Status Mutu</div>
                <i class="dStatusMutu"></i>
              </div>
              <div class="item">
                <div class="header">Sert. ISO</div>
                <i class="dIso"></i>
              </div>
              <div class="item">
                <div class="header">Rayon</div>
                <i class="dRayon"></i>
              </div>
              <div class="item">
                <div class="header">Deskripsi</div>
                <i class="dDeskripsi"></i>
              </div>
              <div class="item">
                <div class="header">Created</div>
                <i class="dCreated"></i>
              </div>
              <div class="item">
                <div class="header">Updated</div>
                <i class="dUpdated"></i>
              </div>
            </div>

        </div>
      </div>
    </div>

    <!-- modal delete -->
    <div class="ui modal deleteSekolah">
      <i class="close icon"></i>
    <div class="header">Delete Data Sekolah</div>
    <div class="content">
      <p>Are you sure to delete this data ?</p>
    </div>
    <div class="actions">
      <div class="ui cancel button">Cancel</div>
      <div class="ui brown button deleteSekolah" data-id="">Delete</div>
    </div>
  </div>
  
@endsection