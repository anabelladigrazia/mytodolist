function actualizarListado(){
    $.ajax( {
        url: "ajax/items?action=itemsUser",
        type: 'GET',
        dataType: 'html',
        success: function (rta) {
            $('#item-list').html(rta);
        },
        error: function (){
            alert("Error");
        }
    } );
}
function logout(){
    $.ajax( {
        url: "ajax/user?action=logout",
        type: 'GET',
        dataType: 'html',
        success: function () {
            location.reload();
        },
        error: function (){
            alert("Error");
        }
    } );
}


$( "body" ).on( "change","#item-list .items-done", function( event ) {
        event.preventDefault();        
        var id = $( this ).val();
        var done;
        if($( this ).prop('checked')){
            done = 1;
        }else{
            done = 0;
        }
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/items?action=updateDone",
            type: 'POST',
            data: { id : id, done: done },
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            dataType: "html",
    	    success: function () {
               document.body.style.cursor = 'auto';
    	    },
    	    error: function (){                
                document.body.style.cursor = 'auto';
                if(done == 1){
                    confirm('Check item as done has failed.');
                    document.getElementById("done-"+id).checked = false;
                }else{
                    confirm('Check item as not done has failed.');
                    document.getElementById("done-"+id).checked = true;
                }
                document.body.style.cursor = 'auto';
    	    }
    	} );
    	
});

$( "body" ).on( "submit","#login-form-container form", function( event ) {
        event.preventDefault();        
        var form = $('#login-form-container form')[0];
        var fd=new FormData(form);
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/user?action=login",
    	    type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
    	    success: function () {
                document.body.style.cursor = 'auto';
                location.reload(true);
    	    },
    	    error: function (rta){
                document.body.style.cursor = 'auto';
                var obj = jQuery.parseJSON(rta.responseText);   
                $('#msj').html(obj.msj);
    	    }
    	} );
    	
});
$( "body" ).on( "submit","#add-container form", function( event ) {
        event.preventDefault();        
        var form = $('#add-container form')[0];
        var fd=new FormData(form);
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/items?action=add",
    	    type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
    	    success: function (rta) {
                document.body.style.cursor = 'auto';
                var obj = jQuery.parseJSON(rta);   
                $('#msj').html(obj.msj);
                $('#myModal').modal('hide');
                actualizarListado();
    	    },
    	    error: function (rta){
                document.body.style.cursor = 'auto';
                var obj = jQuery.parseJSON(rta.responseText);   
                $('#msjAddForm').html(obj.msj);
    	    }
    	} );
    	
});

$( "body" ).on( "submit","#edit-container form", function( event ) {
        event.preventDefault();        
        var form = $('#edit-container form')[0];
        var fd=new FormData(form);
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/items?action=update",
    	    type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
    	    success: function (rta) {
                document.body.style.cursor = 'auto';
                var obj = jQuery.parseJSON(rta);   
                $('#msj').html(obj.msj);
                $('#myModal').modal('hide');
                actualizarListado();
    	    },
    	    error: function (rta){
                document.body.style.cursor = 'auto';
                var obj = jQuery.parseJSON(rta.responseText);   
                $('#msjEditForm').html(obj.msj);
    	    }
    	} );
    	
});

$( "body" ).on( "click",".btn-edit", function( event ) {
        event.preventDefault(); 
        var id = $(this).val();
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/items?action=item",
    	    type: 'POST',
            data: { id : id },
    	    success: function (rta) {
                document.body.style.cursor = 'auto';  
                $('#modal-content').html(rta);
    	    },
    	    error: function (rta){
                document.body.style.cursor = 'auto';
    	    }
    	} );
    	
});
$( "body" ).on( "click",".btn-remove", function( event ) {
        event.preventDefault();
        if(confirm('Are you sure you want to delete this item?')){
            var id = $(this).val();
            document.body.style.cursor = 'wait';
            $.ajax( {
                url: "ajax/items?action=remove",
                type: 'POST',
                data: { id : id },
                success: function (rta) {
                    document.body.style.cursor = 'auto'; 
                    var obj = jQuery.parseJSON(rta);   
                    $('#msj').html(obj.msj);
                    actualizarListado();
                },
                error: function (rta){
                    document.body.style.cursor = 'auto'; 
                    var obj = jQuery.parseJSON(rta);   
                    $('#msj').html(obj.msj);
                }
            } );
        }
});


$( "body" ).on( "click",".btn-add", function( event ) {
        event.preventDefault(); 
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "ajax/items?action=addForm",
    	    success: function (rta) {
                document.body.style.cursor = 'auto';  
                $('#modal-content').html(rta);
    	    },
    	    error: function (){
                document.body.style.cursor = 'auto';
    	    }
    	} );
    	
});