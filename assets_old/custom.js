$( "form" ).submit(function( event ) {
  $( ".btn-submit-for-js" ).click();
  return false;
});

const togglePassword = document.querySelector('#togglePassword');

const password = document.querySelector('#password');

$(".tooltip_class").on('click', function() {

    var id = document.querySelector('#'+$(this).data("id"));
    const type = id
    .getAttribute('type') === 'password' ?
    'text' : 'password';

    id.setAttribute('type', type);

    if(type == "text")
        $(this).attr('src',base_url+'assets_old/frontend/invisible.png');
    else
        $(this).attr('src',base_url+'assets_old/frontend/eye.png');

});

$('#password').keyup(function() {
// $('#password').get(0).type = 'password';
    var pswd = $(this).val();
    if ( pswd.length < 8 ) {
        $('#length').removeClass('valid-pw').addClass('invalid-pw');
    } else {
        $('#length').removeClass('invalid-pw').addClass('valid-pw');
    }
    if ( pswd.match(/[A-z]/) ) {
        $('#letter').removeClass('invalid-pw').addClass('valid-pw');
    } else {
        $('#letter').removeClass('valid-pw').addClass('invalid-pw');
    }
    if ( pswd.match(/[A-Z]/) ) {
        $('#capital').removeClass('invalid-pw').addClass('valid-pw');
    } else {
        $('#capital').removeClass('valid-pw').addClass('invalid-pw');
    }
    if ( pswd.match(/\d/) ) {
        $('#number').removeClass('invalid-pw').addClass('valid-pw');
    } else {
        $('#number').removeClass('valid-pw').addClass('invalid-pw');
    }
    if ( pswd.match(/\W|_/g) ) {
        $('#symbol').removeClass('invalid-pw').addClass('valid-pw');
    } else {
        $('#symbol').removeClass('valid-pw').addClass('invalid');
    }
}).focus(function() {
    $('#tooltip_info').show();
}).blur(function() {
    $('#tooltip_info').hide();
});


// $(document).ready(function() {
//     $.ajax({
//         url: "https://silocloud.com/frontend/Services/getCountryList",
//         method:"POST",
//         data:{

//         },
//         dataType:"json",
//         success:function(response)
//         {
//             country_list = '<option value="1@231">United States</option>';

//             $.each( response.list, function(e,v){
//                 country_list += '<option value="'+v.phonecode+'@'+v.id+'">'+v.name +'</option>';
//             });
//             $("#country_list").html(country_list);
//         },
//         error:function(response)
//         {
//             console.log(response);    
//         }
//     });
// });


$( "#btnLogin" ).click(function(event) {
    let form = document.getElementById("frmLogin");
    let fd = new FormData(frmLogin);

    $.ajax({
        enctype: 'multipart/form-data',
        url: base_url + "auth_login",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            var myObj = JSON.parse(data);

            if(myObj.status)
            {
                setTimeout(function(){
                    window.location.replace(base_url+"dashboard");
                },2000);
            }
            else{
                errorToster('Please Enter Valid Email Id And Password');
            }
        }
    });
});

$( "#btnRegister" ).click(function() {
    let form = document.getElementById("frmRegister");
    let fd = new FormData(form);
    {
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "auth_register",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                var myObj = JSON.parse(data);

                if(myObj.status)
                {
                    successToster('Registration Successfully');
                    setTimeout(function(){

                    },2000);
                }
                else{
                 window.location.href = "login";
                 successToster('Registration failed');
             }
         }

     });
    }
});


$( "#CreateDRS" ).click(function() {
    let form = document.getElementById("form1");
    let fd = new FormData(form);
    
    var attached = document.getElementById('attachedvendor');
    var own = document.getElementById('vendor-options');
    var attachedvehicle = document.getElementById('avehicleno');
    var ownvehicle = document.getElementById('vehicle-options-KALBHOR');
    var ownvehicle1 = document.getElementById('vehicle-options-AKOLA');
    var ownvehicle2 = document.getElementById('vehicle-options-PUNE');
    at = attachedvehicle.value;
    at1 = ownvehicle.value;
    at2 = ownvehicle1.value;
    at3 = ownvehicle2.value;
    dt = attached.value;
    dt1 = own.value;
    fd.append('at', at);
    fd.append('at1', at1);
    fd.append('at2', at2);
    fd.append('at3', at3);
    fd.append('dt', dt);
    fd.append('dt1', dt1);

    let error = false;

    if (fd.get('contractamt') == "") {
        errorToster('Please Enter Contract Amount');
        $('#contractamt').focus();
        error = true;
    }
    else if (fd.get('advancetype') == "") {
        errorToster('Please Enter Hamali Received From Driver');
        $('#advancetype').focus();
        error = true;
    }
    else if (fd.get('advamt') == "") {
        errorToster('Please Enter Advance Amount');
        $('#advamt').focus();
        error = true;
    }
    else if (fd.get('liter') == "") {
        errorToster('Please Enter Fuel Amount');
        $('#liter').focus();
        error = true;
    }
    else if (fd.get('Rate') == "") {
        errorToster('Please Enter Fuel Rate');
        $('#Rate').focus();
        error = true;
    }
    else if (fd.get('thumbnail') == "") {
        errorToster('Please Select Image');
        $('#defaultFile').focus();
        error = true;
    }
    else if (fd.get('dieselvendorname') == "") {
        errorToster('Please Select Diesel Vendorname');
        $('#dieselvendorname').focus();
        error = true;
    }
    else if (fd.get('Dieselbillno') == "") {
        errorToster('Please Enter Fuel Bill No');
        $('#Dieselbillno').focus();
        error = true;
    }
    else if (fd.get('Hvendor') == "") {
        errorToster('Please Select Hamali Vendor');
        $('#Hvendor').focus();
        error = true;
    }
    else if (fd.get('hamali') == "") {
        errorToster('Please Enter Hamali Amount');
        $('#hamali').focus();
        error = true;
    }
    
    if (!error) {
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "drscreate",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('DRS Generated Successfully');
                    setTimeout(function () {
                        window.location.href = base_url + "printdrs/" + myObj.DRSNO;
                    }, 2000);
                } else {
                    errorToster('DRS Not Generated Successfully');
                }
            }
        });
    }
});



$("#Submit").click(function() {
    console.log("79");
    var formData = new FormData($('#form1')[0]);
    if (formData.get('paytype') == "") {
        errorToster('Please Enter paytype');
        console.log("115");
        $('#paytype').focus();
    } else if (formData.get('district') == "") {
        errorToster('Please Enter district');
        console.log("120");
        $('#district').focus();
    } else if (formData.get('WIConsignormob') == "") {
        errorToster('Please Enter consignor WIConsignormob');
        $('#WIConsignormob').focus();
    } else if (formData.get('WIConsignor') == "") {
        errorToster('Please Enter WIConsignor');
        console.log("130");
        $('#WIConsignor').focus();
    }else if (formData.get('WIConsignoradd') == "") {
        errorToster('Please Enter WIConsignoradd');
        $('#WIConsignoradd').focus();
    }else if (formData.get('WIConsigneemob') == "") {
        errorToster('Please Enter WIConsigneemob');
        console.log("140");
        $('#WIConsigneemob').focus();
    }else if (formData.get('WIConsignee') == "") {
        errorToster('Please Enter WIConsignee');
        $('#WIConsignee').focus();
    }else if (formData.get('WIConsigneeadd') == "") {
        errorToster('Please Enter WIConsigneeadd');
        $('#WIConsigneeadd').focus();
    }
    else if (formData.get('freightrate') == "") {
        errorToster('Please Enter freightrate');
        $('#freightrate').focus();
    }
    else if (formData.get('doccharge') == "") {
        errorToster('Please Enter doccharge');
        $('#doccharge').focus();
    } else {
        $('#err_msg').html('');
        var formData = new FormData($('#form1')[0]);
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Cp_lrgenerataion",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if(myObj.status)
                {
                    successToster('LR Generated Successfully');
                    setTimeout(function(){
                      window.location.href = base_url + "printlr/"+ myObj.lr_no;  
                  },2000);
                }
                else{
                    errorToster('LR Generated Successfully ');
                }

            }
        });
    }
});


$( "#CreateTHC" ).click(function() {
    let form = document.getElementById("form1");
    let fd = new FormData(form);

    var LITER = document.getElementById('liter1');
    var RATE = document.getElementById('Rate1');
    var DISELAMT1 = document.getElementById('dieselamt1');
    var attached = document.getElementById('attachedvendor');
    var own = document.getElementById('vendor-options');
    var attachedvehicle = document.getElementById('avehicleno');
    var ownvehicle = document.getElementById('vehicle-options-KALBHOR');
    var ownvehicle1 = document.getElementById('vehicle-options-AKOLA');
    var ownvehicle2 = document.getElementById('vehicle-options-PUNE');
    var fuelvendor =document.getElementById('dieselvendorname1');
    var hamaliname=document.getElementById('Hvendor1');


    var pt4= fuelvendor.value;
    var pt5= hamaliname.value;
    var pt = LITER.value;
    var pt1 = RATE.value;
    var pt2 = DISELAMT1.value;
    var at = attachedvehicle.value;
    var at1 = ownvehicle.value;
    var at2 = ownvehicle1.value;
    var at3 = ownvehicle2.value;
    var dt = attached.value;
    var dt1 = own.value;

    fd.append('pt4', pt4);
    fd.append('pt5', pt5);
    fd.append('pt', pt);
    fd.append('pt1', pt1);
    fd.append('pt2', pt2);
    fd.append('at', at);
    fd.append('at1', at1);
    fd.append('at2', at2);
    fd.append('at3', at3);
    fd.append('dt', dt);
    fd.append('dt1', dt1);


    $.ajax({
        enctype: 'multipart/form-data',
        url: base_url + "thccreate",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            var myObj = JSON.parse(data);
            if (myObj.status) {
                successToster('THC Generated Successfully');
                setTimeout(function(){
                    window.location.href = base_url + "printthc/" + myObj.thc_no;  
                }, 2000);
            } else {
                errorToster('THC Not Generated Successfully');
            }
        }
    });
});





$("#submit_PNADEPO").click(function() {
    let form = document.getElementById("depo_form");
    let fd = new FormData(form);

    $.ajax({
        enctype: 'multipart/form-data',
        url: base_url + "virtual_login",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            var myObj = JSON.parse(data);
            if(myObj.status)
            {
                  // window.location.href = base_url + "cpall_depo";  
                successToster(' depo updated Successfully');
                setTimeout(function(){

                },2000);
            }
            else{
              window.location.href = base_url + "cpall_depo";  
              sucessToster('depo  Generated Successfully ');
          }
      }
  });
});


function successToster(msg) {

    var x = document.getElementById("snackbar");
    x.innerHTML = msg;

    x.classList.remove("error");
    x.classList.add("success");

    x.classList.add("show");
    setTimeout(function(){ 
        x.classList.remove("show"); 
    }, 3000);
}

function errorToster(msg) {
    var x = document.getElementById("snackbar");
    x.innerHTML = msg;

    x.classList.remove("success");
    x.classList.add("error");

    x.classList.add("show");
    setTimeout(function(){ 
        x.classList.remove("show"); 
    }, 3000);
}










