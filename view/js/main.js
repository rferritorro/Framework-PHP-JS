function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,
            beforeSend: function() {
                $("#imgSpinner1").show();
              },
              // hides the loader after completion of request, whether successfull or failor.             
            complete: function() {
                $("#imgSpinner1").hide();
              },
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

function friendlyURL(url) {
    var link="";
    url = url.replace("?", "");
    url = url.split("&");
    cont = 0;
    for (var i=0; i<url.length; i++) {
    	cont++;
        var aux = url[i].split("=");
        if (cont == 2) {
        	link +=  "/"+aux[1]+"/";	
        }else{
        	link +=  "/"+aux[1];
        }
    }

    return "http://localhost/Proyecto_V.4-RafaFerri" + link;
    // return "http://192.168.1.32/Proyecto_V.4-RafaFerri" + link;

}
$(document).ready(function()
{
    if ($('div#default_panel')) {
        var random = Math.floor(Math.random() * 9);
        var array = ["fa-user","fa-user-astronaut","fa-user-graduate","fa-user-injured","fa-user-md","fa-user-ninja","fa-user-nurse","fa-user-secret","fa-user-tie"];
        $('<i></i>').attr({'class':'fa '+ array[random] +' fa-3x'}).appendTo('div#default_panel');
        $('<h3></h3>').html("Login In").appendTo('#default_panel');
        //console.log(random);
    } 
})

