function validate()
{  
    
    $("#frm-loginForm input[name=hpassword]").val(
        hex_sha512($("#frm-loginForm input[name=password]").val())
    );
    $("#frm-loginForm input[name=hpassword]").val(
        hex_sha512($("#frm-loginForm input[name=hpassword]").val() + $("#frm-loginForm input[name=challenge]").val())
    );
    if($("#frm-loginForm input[name=password]").val() != "" || $("#frm-loginForm input[name=account]").val() != ""){
        $("#frm-loginForm input[name=password]").prop('disabled', true);
    }
}