$(document).ready(function(){
	$(function(){
            $("#submit").click(function(){
            	valid = true;
                if($("#name").val()==""){
                    $("#name").css("border-color","#FF0000");
                    valid = false;
                }else{
                	$("#name").css("border-color","#00FF00");
                	$("#name").next(".error-message").text("");
                }



                 if($("#othername").val()==""){
                    $("#othername").css("border-color","#FF0000");
                    $("#othername").next(".error-message").text("Champ pas valide");
                    valid = false;
                }else{
                	$("#othername").css("border-color","#00FF00");
                	$("#othername").next(".error-message").text("");
                }



                 if($("#username").val()==""){
                    $("#username").css("border-color","#FF0000");
                    $("#username").next(".error-message").text("Champ pas valide");
                    valid = false;
                }else{
                	$("#username").css("border-color","#00FF00");
                	$("#username").next(".error-message").text("");
                }




                 if($("#email").val()==""){
                    $("#email").css("border-color","#FF0000");
                    $("#email").next(".error-message").text("Champ pas valide");
                    valid = false;
                }else{
                	if(!$("#email").val().match(/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i)){
                		$("#email").css("border-color","#FF0000");
                    	$("#email").next(".error-message").text("Veuillez entrez un mail valide");
                	}else{
                		$("#email").css("border-color","#00FF00");
                		$("#email").next(".error-message").text("");
                	}
                }
                    if($("#email2").val() !== $("#email").val()){
                        $("#email2").css("border-color","#FF0000");
                        $("#email2").next(".error-message").text("Les deux mots de passe ne correspondent pas");
                        valid = false;
                    }else if($("#email2").val() !== $("#email").val()){
                	    $("#email2").css("border-color","#FF0000");
                	    $("#email2").next(".error-message").text("");
                    }else{
                        $("#email2").css("border-color","#00FF00");
                	    $("#email2").next(".error-message").text("");
                    }
                



                    if($("#password").val()==""){
                        $("#password").css("border-color","#FF0000");
                        $("#password").next(".error-message").text("Champ pas valide");
                        valid = false;
                    }else{
                	    $("#password").css("border-color","#00FF00");
                	    $("#password").next(".error-message").text("");
                    }
                    if($("#cpassword").val()!== $("#password").val()){
                        $("#cpassword").css("border-color","#FF0000");
                        $("#cpassword").next(".error-message").text("Les deux mots de passe ne correspondent pas");
                        valid = false;
                    }else if($("#cpassword").val()== $("#password").val()){
                	    $("#cpassword").css("border-color","#FF0000");
                	    $("#cpassword").next(".error-message").text("");
                    }else{
                        $("#cpassword").css("border-color","#00FF00");
                	    $("#cpassword").next(".error-message").text("");
                    }
               return valid;
            });
            
            
        });


})