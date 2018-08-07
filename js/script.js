

$(document).ready(function(){
    $('#userForm').submit(function(){
        var messsageLogin = $(this).siblings('#result');

        $.ajax({
            type: 'POST',
            url: '/ica/include/adminView.php', 
            data: $(this).serialize()
        })
        .done(function(data){
            if(data == "Username sau parola gresita")
            {
            	 messsageLogin.append("<i class='fa fa-info-circle'></i> " + data).delay(3000).fadeOut(300);
                 setTimeout(function(){
                messsageLogin.empty();                
                }, 3500);
                messsageLogin.css('display', 'block');
            } else if (data == "Parola gresita"){
                     messsageLogin.append("<i class='fa fa-info-circle'></i> " + data).delay(3000).fadeOut(300);
                 setTimeout(function(){
                messsageLogin.empty();                
                }, 3500);
                 messsageLogin.css('display', 'block');
            }
            else {
            	window.location.replace("http://localhost:8080/ica/admin/welcome.php");
            }         
        })
        .fail(function() {
         
            // just in case posting your form failed
            alert( "Posting failed." );           
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });


$('.deleteProg').on('click', function(){

    	var parent = $(this).parent();
    	var child = parent.children('input');
    	var inputVal = child.val();
    	var line = $(this).parent().parent();
    	var findMessage = $(this).parents('.table-responsive');
    	var message = findMessage.siblings('#message');
    	console.log(message);
    	$.ajax({
    		type: 'POST',
    		url: '/ica/include/deleteProg.php',
    		data: {
    			id: inputVal
    		},
    		success: function(responsedata) {
    			line.fadeOut(500, function() {
    				$(this).remove();
    			});
    			message.css('display', 'block');
    			message.append("<i class='fa fa-info-circle'></i>" + responsedata).delay(3000).fadeOut(300);
    			 setTimeout(function(){
  				message.empty(); 				
				}, 3500);

    		},
    		error: function () {
            console.error('Failed to process ajax !');
        }
    	});
    });

$('.deleteDoctor').on('click', function(){

    	var parent = $(this).parent();
    	var child = parent.children('#idDeleteDoctor');
    	var inputVal = child.val();
    	var line = $(this).parent().parent();
    	var findMessage = $(this).parents('.table-responsive');
    	var message = findMessage.siblings('#messageDoctor');
    	$.ajax({
    		type: 'POST',
    		url: '/ica/include/deleteDoctor.php',
    		data: {
    			id: inputVal
    		},
    		success: function(responsedata) {
    			line.fadeOut(500, function() {
    				$(this).remove();
    			});
    			message.css('display', 'block');
    			message.append("<i class='fa fa-info-circle'></i>" + responsedata).delay(3000).fadeOut(300);
    			 setTimeout(function(){
  				message.empty(); 				
				}, 3500);

    		},
    		error: function () {
            console.error('Failed to process ajax !');
        }
    	});
    });

$('.deleteUseri').on('click', function(){

    	var parent = $(this).parent();
    	var child = parent.children('#idDeleteUser');
    	var inputVal = child.val();
    	var line = $(this).parent().parent();
    	var findMessage = $(this).parents('.table-responsive');
    	var message = findMessage.siblings('#messageUser');
    	$.ajax({
    		type: 'POST',
    		url: '/ica/include/User.php',
    		data: {
    			id: inputVal
    		},
    		success: function(responsedata) {
    			line.fadeOut(500, function() {
    				$(this).remove();
    			});
    			message.css('display', 'block');
    			message.append("<i class='fa fa-info-circle'></i>" + responsedata).delay(3000).fadeOut(300);
    			 setTimeout(function(){
  				message.empty(); 				
				}, 3500);

    		},
    		error: function () {
            console.error('Failed to process ajax !');
        }
    	});
    });

});




 $(function () {
            $('#datetimepicker4').datetimepicker({
                       format: "YYYY-MM-DD",
                       locale: "ro"
                });     
});

$(document).ready(function(){

  $('#updateProg').submit(function(){
  	var message = $(this).siblings('#messageProg');
        $.ajax({
            type: 'POST',
            url: '/ica/include/updateProgramari.php', 
            data: $(this).serialize()
        })
        .done(function(data){
  
            	  message.append("<i class='fa fa-info-circle'></i> " + data).delay(3000).fadeOut(300);
            	 setTimeout(function(){
  				message.empty(); 				
				}, 3500);
            	 message.css('display', 'block');                       
        })
        .fail(function() {
         
            // just in case posting your form failed
            alert( "Posting failed." );           
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });

$('#updateUser').submit(function(){
  	var message = $(this).siblings('#messageUser');
        $.ajax({
            type: 'POST',
            url: '/ica/include/updateUser.php', 
            data: $(this).serialize()
        })
        .done(function(data){
  
            	  message.append("<i class='fa fa-info-circle'></i>" + data).delay(3000).fadeOut(300);
            	 setTimeout(function(){
  				message.empty(); 				
				}, 3500);
            	 message.css('display', 'block');                       
        })
        .fail(function() {
         
            // just in case posting your form failed
            alert( "Posting failed." );           
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });

  $('#updateDoctor').submit(function(){
  	var message = $(this).siblings('#updateMessage');

        $.ajax({
            type: 'POST',
            url: '/ica/include/updateDoctori.php', 
            data: $(this).serialize()
        })
        .done(function(data){
  
            	 message.append("<i class='fa fa-info-circle'></i>" + data).delay(3000).fadeOut(300);
            	 setTimeout(function(){
  				message.empty(); 				
				}, 3500);
            	 message.css('display', 'block');
                       
        })
        .fail(function() {
         
            // just in case posting your form failed
            alert( "Posting failed." );           
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });
});