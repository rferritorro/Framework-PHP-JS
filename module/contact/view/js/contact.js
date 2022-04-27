function validate_data() {
    $(document).on('click','#button_email',function () {
        var email = document.getElementById('email').value
        var matter = document.getElementById('matter').value
        var description = document.getElementById('description').value
        var checker = false;
        var pmatter = /^[a-zA-Z]+[\-'\s]?[a-zA-Z]{2,51}$/;
	    var pmessage = /^[0-9A-Za-z\s]{20,150}$/;
    	var pmail = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        if (email === "") {
            console.log("hola")
        }
        if ( email == null || email === "" || !email) {
            toastr.error("Profavor escriba un email")
            checker=true
        } else {
            if (!pmail.test(email)) {
                toastr.error("Formato de mail incorrecto")
                checker=true
            }
        }
        if ( matter == null || matter === "" || !matter) {
            toastr.error("Profavor escriba un asunto")
            checker=true
        } else {
            if (!pmatter.test(matter)) {
                toastr.error("Formato de asunto incorrecto")
                checker=true
            }

        }
        if ( description == null || description === "" || !description ) {
            toastr.error("Escriba un mensaje")
            checker=true
        } else {
            if (!pmessage.test(description)) {
                toastr.error(" Error mensaje tiene que contener mínimo 20, máximo 150 carácteres")
                checker=true
            }
        }
        if (!checker) {
           sendemail(email,matter,description)
        }
    });
}
function sendemail(email,matter,description) {
    var data = {"email": email,"asunto": matter, "mensaje": description};

    ajaxPromise(friendlyURL('?page=contact&op=sendemail'),'POST','JSON',data)
    .then(function(data) {
        if (data == "Error!") {
            toastr.error("Error");
        } else {
            toastr.info("Mensaje enviado")
        }
    }).catch(function(info) {
        // window.location.href = "index.php?exceptions=controller&option=503";
        console.log(info);
    });  
}
$(document).ready(function () {
    validate_data();
});