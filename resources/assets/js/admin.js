// admin
$(document).ready(function(){
	//set
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'myProfileAdmin'		: 'myProfileAdmin/{username}',
        'updateMyProfile'       : 'updateMyProfileAdmin',
        'listAdmin'             : 'listAdmin',
        'detailAdmin'           : 'detailAdmin/{username}',
        'deleteAdmin'           : 'deleteAdmin/{username}',
        'mDeleteAdmin'          : 'mDeleteAdmin',
        'storeAdmin'            : 'storeAdmin',
        'updateAdmin'           : 'updateAdmin',
        'listUser'              : 'listUser',
        'detailUser'            : 'detailUser/{id}',
        'deleteUser'            : 'deleteUser/{id}',
        'mDeleteUser'           : 'mDeleteUser',
        'updateUser'            : 'updateUser',
        'listSekolah'           : 'listSekolah',
        'detailSekolah'         : 'detailSekolah/{id}',
        'deleteSekolah'         : 'deleteSekolah/{id}',
        'mDelSekolah'           : 'mDelSekolah',
        'storeSekolah'          : 'storeSekolah',
        'updateSekolah'         : 'updateSekolah',
        'listKomentar'          : 'listKomentar',
        'deleteKomentar'        : 'deleteKomentar/{id}',
        'mDelKomentar'          : 'mDelKomentar',
        'listLike'              : 'listLike',
    };

    //set ui
    $('.ui.dropdown').dropdown({
        on: 'hover'
    }); // dropdown initialization
    $('.ui.sidebar')
        .sidebar('setting', 'transition', 'overlay')
        .sidebar('attach events', '.item.sidebar-button')
    ;
    $('.ui.checkbox').checkbox();

    // MY PROFILE ADMIN
    // isi data ke modal form
    $('.button.editMyAccount').api({
        action: 'myProfileAdmin',
        method : 'GET',
        urlData: $(this).data("username"),
        onSuccess: function(d) {
        	// show modal
        	$('.modal.myProfile').modal('show');
        	// isi form
            $('.fUsername').val(d.username);
            $('.fPassword').val(d.password);
            $('.fEmail').val(d.email);
            $('.fKeyMyProfile').val(d.username);
        },
        onFailure: function(response) {
            alert('refresh page');
        }
    });
    // update data
    $( ".button.updateMyProfile" ).on( "click", function(e) {
        e.preventDefault();
    });
    $( ".form.myProfile" ).on( "submit", function(e) {
        e.preventDefault();
    });
    $('.button.updateMyProfile').api({
        action: 'updateMyProfile',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.myProfile")[0]);
            return settings;
        },
        onSuccess: function(d) {
            if(d == 0){
                alertNoty('Can not update, use another Username','warning');
            }else{
                alertNoty('Update Success','info');
                $('.modal.myProfile').modal('hide');
                $('.topUsername').html(d.username);
                $('.vUsername').html(d.username);
                $('.vPassword').html(d.password);
                $('.vEmail').html(d.email);
                $('.vLastLogin').html(cekDate(d.last_login));
                $('.vCreated').html(cekDate(d.created_at));
                $('.vUpdated').html(cekDate(d.updated_at));
                $('.button.editMyAccount').data("username",d.username);
            }
        },
        onFailure: function(r) {
            $('.form.myProfile').form('validate form');
            
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });
    // validate form my Profile
    $('.form.myProfile')
      .form({
        fields: {
          username: {
            identifier: 'username',
            rules: [
              {
                type   : 'empty',
              }
            ]
          },
          password: {
            identifier: 'password',
            rules: [
              {
                type   : 'empty',
              }
            ]
          },
          email: {
            identifier: 'email',
            rules: [
              {
                type   : 'empty',
              }
            ]
          }
        }
      })
    ;

    // CRUD ADMIN
    var ceAdmin     = '';
    var idCeAdmin   = '';
    var actCeAdmin  = '';
    
    if( $('#tbAdmin').length ) 
    {
        $('.modal.ceAdmin')
          .modal('attach events', '.btn.addAdmin', 'show')
          .modal('setting', 'closable', false)
        ;
        listAdmin();
    }
    function listAdmin(d) {
        $('#tbAdmin').api({
        action: 'listAdmin',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableAdmin(d);
        }
      });
    }
    function drawTableAdmin(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxAdmin">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbAdminSub" data-username="'+d[key].username+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].username+'</td>'+
                                '<td>'+d[key].password+'</td>'+
                                '<td>'+d[key].email+'</td>'+
                                '<td>'+jabatanAdmin(d[key].akses)+'</td>'+
                                '<td>'+cekDate(d[key].last_login)+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon button ddAdmin">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item mAdmin detailAdmin" data-username="'+d[key].username+'"><i class="user icon"></i></div>'+
                                        '<div class="item mAdmin editAdmin" data-username="'+d[key].username+'" data-aksiceadmin="1"><i class="edit icon"></i></div>'+
                                        '<div class="item mAdmin deleteAdmin" data-username="'+d[key].username+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbAdmin").html('');
        $("#tbAdmin").html(list);
        initTableAdmin();
    }
    function initTableAdmin(){
        $('.ui.checkboxAdmin').checkbox();
        $('.ui.dropdown.ddAdmin').dropdown({
            on: 'hover'
        });

        //detail admin
        $('.mAdmin.detailAdmin').api({
            action: 'detailAdmin',
            urlData: {
              username: $(this).data('username')
            },
            method : 'GET',
            onSuccess: function(d) {
               $('.modal.detailAdmin').modal('show');
               // isi modal
               $('.dAdminUsername').html(d.username);
               $('.dAdminPassword').html(d.password);
               $('.dAdminEmail').html(d.email);
               $('.dAdminAkses').html(jabatanAdmin(d.akses));
               $('.dAdminCreated').html(cekDate(d.created_at));
               $('.dAdminUpdated').html(cekDate(d.updated_at));
               $('.dAdminLastLogin').html(cekDate(d.last_login));
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete admin
        $('.modal.deleteAdmin')
          .modal('attach events', '.mAdmin.deleteAdmin', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.mAdmin.deleteAdmin').on("click", function(e) {
            $('.button.deleteAdmin').data('username',$(this).data('username'));
        });
        $('.button.deleteAdmin').api({
            action: 'deleteAdmin',
            urlData: {
              username: $(this).data('username')
            },
            method : 'GET',
            onSuccess: function(d) {
               $('.modal.deleteAdmin').modal('hide');
               listAdmin();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        // Del Multiple record
        // checkbox master
        $('.master.checkbox.checkboxAdmin')
          .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbAdminSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbAdminSub").prop('checked', false); 
            }
          });
        $('.btn.mDeleteAdmin').api({
            action: 'mDeleteAdmin',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbAdminSub:checked").each(function() {  
                    ids.push($(this).attr('data-username'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listAdmin();
            },
            onFailure: function(d) {
                alert('refresh page')
            }
        });

        // create / update admin
        // isi form edit
        $('.mAdmin.editAdmin').api({
            action: 'detailAdmin',
            urlData: {
              username: $(this).data('username')
            },
            method : 'GET',
            onSuccess: function(d) {
               $('.form.ceAdmin').form('clear');
               // isi form
               $('#keyAdmin').val(d.username);
               $('#username').val(d.username);
               $('#password').val(d.password);
               $('#email').val(d.email);
               $('.dropdown.akses').dropdown('set selected',d.akses.toString());
               $('.modal.ceAdmin').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        //set actCeAdmin
        $( ".btn.addAdmin , .mAdmin.editAdmin" ).on( "click", function(e) {
            ceAdmin = $(this).data('aksiceadmin');
            if(ceAdmin == '0'){
                actCeAdmin = 'storeAdmin';
                $('.form.ceAdmin').form('clear');
            }else{
                actCeAdmin = 'updateAdmin';
            }
        });
        $( ".button.saveAdmin" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.ceAdmin" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.button.saveAdmin').api({
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.action = actCeAdmin;
                settings.data = new FormData($(".form.ceAdmin")[0]);
                return settings;
            },
            onSuccess: function(d) {
                if(d == 0){
                    alertNoty('Can not update, use another Username','warning');
                }else{
                    alertNoty('Save Success','info');
                    $('.modal.ceAdmin').modal('hide');
                    $('.form.ceAdmin').form('clear');
                    listAdmin();
                }
            },
            onFailure: function(r) {
                $('.form.ceAdmin').form('validate form');
                
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });
        // validasi form ceAdmin
        $('.form.ceAdmin')
          .form({
            fields: {
              username: {
                identifier: 'username',
                rules: [
                  {
                    type   : 'empty',
                  }
                ]
              },
              password: {
                identifier: 'password',
                rules: [
                  {
                    type   : 'empty',
                  }
                ]
              },
              email: {
                identifier: 'email',
                rules: [
                  {
                    type   : 'empty',
                  }
                ]
              },
              akses: {
                identifier: 'akses',
                rules: [
                  {
                    type   : 'empty',
                  }
                ]
              }
            }
          })
        ;
    }

    // RUD User
    var eUser       = '';
    var idUser      = '';
    var actEUser    = '';
    if( $('#tbUser').length ) 
    {
        listUser();
    }
    function listUser(d) {
        $('#tbUser').api({
        action: 'listUser',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableUser(d);
        }
      });
    }
    function drawTableUser(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxUser">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbUserSub" data-username="'+d[key].id+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].id+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].nik+'</td>'+
                                '<td>'+d[key].pekerjaan+'</td>'+
                                '<td>'+cekDate(d[key].last_login)+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon button ddUser">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item mUser detailUser" data-username="'+d[key].id+'"><i class="user icon"></i></div>'+
                                        '<div class="item mUser editUser" data-username="'+d[key].id+'" data-aksieuser="1"><i class="edit icon"></i></div>'+
                                        '<div class="item mUser deleteUser" data-username="'+d[key].id+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbUser").html('');
        $("#tbUser").html(list);
        initTableUser();
    }

    function initTableUser(a) {
        $('.ui.checkboxUser').checkbox();
        $('.ui.dropdown.ddUser').dropdown({
            on: 'hover'
        });

        // detail User
        $('.mUser.detailUser').api({ 
            action: 'detailUser',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("username");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi modal
               $('.dUserId').html(d.id);
               $('.dUserPassword').html(d.password);
               $('.dUserEmail').html(d.email);
               $('.dUserNama').html(d.nama);
               $('.dUserNik').html(d.nik);
               $('.dUserTempatLahir').html(d.tempat_lahir);
               $('.dUserTglLahir').html(cekDate(d.tgl_lahir+' .'));
               $('.dUserKelamin').html(vKelamin(d.kelamin));
               $('.dUserPekerjaan').html(d.pekerjaan);
               $('.dUserAlamat').html(d.alamat_lengkap);
               $('.dUserTlp').html(d.tlp);
               $('.dUserLastLogin').html(cekDate(d.last_login));
               $('.dUserCreated').html(cekDate(d.created_at));
               $('.dUserUpdated').html(cekDate(d.updated_at));
               $('.modal.detailUser').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete User
        $('.modal.deleteUser')
          .modal('attach events', '.mUser.deleteUser', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.mUser.deleteUser').on("click", function(e) {
            $('.button.deleteUser').data('username',$(this).data('username'));
        });
        $('.button.deleteUser').api({
            action: 'deleteUser',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("username");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deleteUser').modal('hide');
               alertNoty('Delete Success','info');
               listUser();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // Del Multiple record
        // checkbox master
        $('.master.checkbox.checkboxUser')
          .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbUserSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbUserSub").prop('checked', false); 
            }
          });
        $('.btn.mDeleteUser').api({
            action: 'mDeleteUser',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbUserSub:checked").each(function() {  
                    ids.push($(this).attr('data-username'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listUser();
            },
            onFailure: function(d) {
                alert('refresh page')
            }
        });

        // edit User
        // isi form
        $('.mUser.editUser').api({
            action: 'detailUser',
            method : 'GET',
            beforeSend: function(set){
                id = $(this).data("username");  
                set.urlData = {
                    id : id
                };
                return set;
            },
            onSuccess: function(d) {
                $('.form.eUser').form('clear');
                // isi form
                $('#keyUser').val(d.id);
                $('#idUser').val(d.id);
                $('#passwordUser').val(d.password);
                $('#emailUser').val(d.email);
                $('#namaUser').val(d.nama);
                $('#nikUser').val(d.nik);
                $('#tempatLahirUser').val(d.tempat_lahir);
                $('#tglLahirUser').val(d.tgl_lahir);
                $('.dropdown.kelamin').dropdown('set selected',d.kelamin.toString());
                $('#pekerjaanUser').val(d.pekerjaan);
                $('#alamatLengkapUser').val(d.alamat_lengkap);
                $('#tlpUser').val(d.tlp);
                // show modal
                $('.modal.eUser').modal('show');
            },
            onFailure: function(response) {
                alert('refresh page');
            }
        });
        // update user
        $( ".button.saveUser" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.eUser" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.button.saveUser').api({
            action: 'updateUser',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.eUser")[0]);
                return settings;
            },
            onSuccess: function(d) {
                if(d == 0){
                    alertNoty('Can not update, use another Username','warning');
                }else{
                    alertNoty('Update Success','info');
                    $('.modal.eUser').modal('hide');
                    listUser();
                }
            },
            onFailure: function(r) {
                $('.form.eUser').form('validate form');
                
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });
        // validate form Edit User
        $('.form.eUser')
          .form({
            fields: {
              id                : 'empty',
              password          : 'empty',
              email             : 'empty',
              nama              : 'empty',
              nik               : 'empty',
              tempat_lahir      : 'empty',
              tgl_lahir         : 'empty',
              kelamin           : 'empty',
              pekerjaan         : 'empty',
              alamat_lengkap    : 'empty',
              tlp               : 'empty',
            }
          })
        ;
    }

    //CRUD SEKOLAH
    // RUD User
    var idSekolah      = '';
    var eSekolah       = '';
    var actESekolah    = '';
    if( $('#tbSekolah').length ) 
    {
        listSekolah();
    }
    function listSekolah(d) {
        $('#tbSekolah').api({
        action: 'listSekolah',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableSekolah(d);
        }
      });
    }
    function drawTableSekolah(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxSekolah">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbSekolahSub" data-id="'+d[key].id+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].email+'</td>'+
                                '<td>'+d[key].akreditas+'</td>'+
                                '<td>'+d[key].website+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon button ddSekolah">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailSekolah" data-id="'+d[key].id+'"><i class="user icon"></i></div>'+
                                        '<div class="item editSekolah" data-id="'+d[key].id+'" data-aksi="1"><i class="edit icon"></i></div>'+
                                        '<div class="item deleteSekolah" data-id="'+d[key].id+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbSekolah").html('');
        $("#tbSekolah").html(list);
        initTableSekolah();
    }

    function initTableSekolah(){
        $('.ui.checkboxSekolah').checkbox();
        $('.ui.dropdown.ddSekolah').dropdown({
            on: 'hover'
        });

        // reset form
        $('.close.icon.ceSekolah , .cancel.button.ceSekolah').on("click", function(e) {
            $('.form.ceSekolah').form('clear');
        });

        // detail
        $('.item.detailSekolah').api({ 
            action: 'detailSekolah',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi modal
               $('.dNama').html(d.nama);
               $('.dAlamat').html(d.alamat);
               $('.dEmail').html(d.email);
               $('.dTlp').html(d.tlp);
               $('.dAkreditas').html(d.akreditas);
               $('.dWebsite').html(d.website);
               $('.dDeskripsi').html(d.deskripsi);
               $('.dKepSek').html(d.kep_sek);
               $('.dStatusMutu').html(d.status_mutu);
               $('.dIso').html(d.sertifikasi_iso);
               $('.dRayon').html(d.rayon);
               $('.dCreated').html(cekDate(d.created_at));
               $('.dUpdated').html(cekDate(d.updated_at));
               $('.dFoto').attr('src',urlWeb+'/img/sekolah/'+d.foto);
               
               $('.modal.detailSekolah').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete
        $('.modal.deleteSekolah')
          .modal('attach events', '.item.deleteSekolah', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deleteSekolah').on("click", function(e) {
            $('.button.deleteSekolah').data('id',$(this).data('id'));
        });
        $('.button.deleteSekolah').api({
            action: 'deleteSekolah',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deleteSekolah').modal('hide');
               alertNoty('Delete Success','info');
               listSekolah();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        // checkbox master
        $('.master.checkbox.checkboxSekolah')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbSekolahSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbSekolahSub").prop('checked', false); 
            }
          });
        $('.btn.mDelSekolah').api({
            action: 'mDelSekolah',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbSekolahSub:checked").each(function() {  
                    ids.push($(this).attr('data-id'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listSekolah();
            },
            onFailure: function(d) {
                alert('refresh page')
            }
        });

        // create
        $('.modal.ceSekolah')
          .modal('attach events', '.btn.addSekolah', 'show')
          .modal('setting', 'closable', false)
        ;
        $( ".button.saveSekolah" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.ceSekolah" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.button.saveSekolah').api({
            action: 'storeSekolah',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.ceSekolah")[0]);
                return settings;
            },
            onSuccess: function(d) {
                if(d == 0){
                    alertNoty('Can not update, use another Username','warning');
                }else{
                    alertNoty('Update Success','info');
                    $('.modal.ceSekolah').modal('hide');
                    $('.form.ceSekolah').form('clear');
                    listSekolah();
                }
            },
            onFailure: function(r) {
                // $('.form.eUser').form('validate form');
                
                // nf='<ul>';
                // $.each( r, function( key, value ) {
                //     nf += '<li>' + value + '</li>'; 
                // });    
                // nf+='</ul>';
                // alertNoty(nf,'warning');
                alertNoty('Alert Failure','warning');
            }
        });

        // EDIT
        // isi form
        $('.item.editSekolah').api({ 
            action: 'detailSekolah',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi form
               $('.eSekolah #keySekolah').val(d.id);
               $('.eSekolah #nama').val(d.nama);
               $('.eSekolah #alamat').val(d.alamat);
               $('.eSekolah #email').val(d.email);
               $('.eSekolah #tlp').val(d.tlp);
               $('.eSekolah #akreditas').val(d.akreditas);
               $('.eSekolah #website').val(d.website);
               $('.eSekolah #deskripsi').val(d.deskripsi);
               $('.eSekolah #kep_sek').val(d.kep_sek);
               $('.eSekolah .dropdown.status_mutu').dropdown('set selected',d.status_mutu);
               $('.eSekolah #sertifikasi_iso').val(d.sertifikasi_iso);
               $('.eSekolah .dropdown.rayon').dropdown('set selected',d.rayon.toString());
               $('.eSekolah #lat').val(d.lat);
               $('.eSekolah #long').val(d.long);
               $('.eSekolah #oldFoto').val(d.foto);

               $('.modal.eSekolah').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // update
        $( ".button.updateSekolah" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.eSekolah" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.button.updateSekolah').api({
            action: 'updateSekolah',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.eSekolah")[0]);
                return settings;
            },
            onSuccess: function(d) {
                if(d == 0){
                    alertNoty('Can not update','warning');
                }else{
                    alertNoty('Update Success','info');
                    $('.modal.eSekolah').modal('hide');
                    $('.form.eSekolah').form('clear');
                    listSekolah();
                }
            },
            onFailure: function(r) {
                // $('.form.eUser').form('validate form');
                
                // nf='<ul>';
                // $.each( r, function( key, value ) {
                //     nf += '<li>' + value + '</li>'; 
                // });    
                // nf+='</ul>';
                // alertNoty(nf,'warning');
                alertNoty('Can not update','warning');
            }
        });

    }

    // KOMENTAR rd
    // tabel
    if( $('#tbKomentar').length ) 
    {
        listKomentar();
    }
    function listKomentar(d) {
        $('#tbKomentar').api({
        action: 'listKomentar',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableKomentar(d);
        }
      });
    }
    function drawTableKomentar(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxKomentar">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbKomentarSub" data-id="'+d[key].id+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].id_user+'</td>'+
                                '<td>'+d[key].nama_sekolah+'</td>'+
                                '<td>'+d[key].waktu+'</td>'+
                                '<td>'+d[key].teks+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon button ddKomentar">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item deleteKomentar" data-id="'+d[key].id+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbKomentar").html('');
        $("#tbKomentar").html(list);
        initTableUser();
    }

    function initTableUser (){
        $('.ui.checkboxKomentar').checkbox();
        $('.ui.dropdown.ddKomentar').dropdown({
            on: 'hover'
        });

        // DELETE
        $('.modal.deleteKomentar')
          .modal('attach events', '.item.deleteKomentar', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deleteKomentar').on("click", function(e) {
            $('.button.deleteKomentar').data('id',$(this).data('id'));
        });
        $('.button.deleteKomentar').api({
            action: 'deleteKomentar',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deleteKomentar').modal('hide');
               alertNoty('Delete Success','info');
               listKomentar();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // MULTIPLE DELETE
        $('.master.checkbox.checkboxKomentar')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbKomentarSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbKomentarSub").prop('checked', false); 
            }
          });
        $('.btn.mDeleteKomentar').api({
            action: 'mDelKomentar',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbKomentarSub:checked").each(function() {  
                    ids.push($(this).attr('data-id'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listKomentar();
            },
            onFailure: function(d) {
                alert('refresh page')
            }
        });
    }

    // LIKE
    if( $('#tbLike').length ) 
    {
        listLike();
    }
    function listLike(d) {
        $('#tbLike').api({
        action: 'listLike',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableLike(d);
        }
      });
    }
    function drawTableLike(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].email+'</td>'+
                                '<td>'+d[key].akreditas+'</td>'+
                                '<td>'+d[key].jml_like+'</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbLike").html('');
        $("#tbLike").html(list);
    }


    function alertNoty(m,ty){
    	new Noty({
                theme   : 'relax',
                text    : m,
                type    : ty,
                timeout : 3000
              }).show()
    }

    function cekDate(d){
        if(d == null){
            d = '-';
        }else{
            d = changeDate(d)
        }
        return d;
    }

    function changeDate(d){
        var dt      = d.split(" ");
        var date    = dt[0].split('-');
        date        = date[2]+'-'+date[1]+'-'+date[0]+' '+dt[1];
        return date;
    }

    function jabatanAdmin(d){
        if (d == 1) {
            d = 'Master Admin';
        }else{
            d = 'Guest Admin';
        }
        return d;
    }

    function vKelamin(d) {
        if(d == '1'){
            return 'Pria';
        }else{
            return 'Wanita';
        }
    }

});