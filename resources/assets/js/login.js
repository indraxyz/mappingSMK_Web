// login
var urlWeb = "http://"+window.location.hostname+":8000"; // ganti jika di hosting

$(document).ready(function(){
	//set
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'login'        : 'loginAdmin'
    };

    //cek login
    $( ".button.login" ).on( "click", function(e) {
        e.preventDefault();
    });
    $('.button.login').api({
        action: 'login',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.loginAdmin")[0]);
            return settings;
        },
        onSuccess: function(d) {
            if(d){
                location.href = urlWeb + '/homeAdmin';
                alertNoty('Login Success', 'info');
            }else{
                alertNoty('Login Failed','warning');
            }
            
        },
        onFailure: function(response) {
            alert('refresh page');
        }
    });

    function alertNoty(m,ty){
    	new Noty({
                text: m,
                type: ty,
                timeout: 2500
              }).show()
    }

});
