function validate()
{  
    $("#frm-adminLoginForm input[name=hpassword]").val(
        hex_sha512($("#frm-adminLoginForm input[name=password]").val())
    );
    $("#frm-adminLoginForm input[name=hpassword]").val(
        hex_sha512($("#frm-adminLoginForm input[name=hpassword]").val() + $("#frm-adminLoginForm input[name=challenge]").val())
    );
    
    if($("#frm-adminLoginForm input[name=password]").val() != "" || $("#frm-adminLoginForm input[name=account]").val() != ""){
        $("#frm-adminLoginForm input[name=password]").prop('disabled', true);
    }
}