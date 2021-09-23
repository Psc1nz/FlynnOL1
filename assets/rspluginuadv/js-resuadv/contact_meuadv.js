/* Ultimate Advancedd PRO Contact XL Script with recaptcha2 by Steve Riches - RichoSoft Squared - (C) 2017 - All Rights Reserved */
/* December 2017 - www.richosoft2.co.uk */
$(function() {
  $('input[type=text]').each(function(){
  if($(this).prop('required')==false || $(this).prop('required')=='undefined') {
  $(this).removeAttr('data-validation-required-message');
  }
  else
  {
	  $(this).css("border-color","#2c2323");
	  $(this).css("borderWidth","2px");
  }
  });
  $('select').each(function(){
  if($(this).prop('required')==false || $(this).prop('required')=='undefined') {
  $(this).removeAttr('data-validation-required-message');
  }
  else
  {
	  $(this).css("border-color","#2c2323");
	  $(this).css("borderWidth","2px");
  }
  });
	  $('#message').css("border-color","#2c2323");
	  $('#message').css("borderWidth","2px");
	  $('#email').css("border-color","#2c2323");
	  $('#email').css("borderWidth","2px");


    $("#contactForm input,#contactForm select,#contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
        },
        submitSuccess: function($form, event) {
            event.preventDefault();
			var thefiles=$("#filelist").html();
			if(thefiles=="" || thefiles===null){
			thefiles="|na|"; }
			var sendto = $("#to").html();
			if( $('#selectdate-div').length ){
			var selectdate = $("#selectdate").val();
			var selectdatename = $("#selectdate").attr('placeholder');
			}else{var selectdate="|na|";
			var selectdatename = "|na|";}
			if( $('#selectdate2-div').length ){
			var selectdate2 = $("#selectdate2").val();
			var selectdatename2 = $("#selectdate2").attr('placeholder');
			}else{var selectdate2="|na|";
			var selectdatename2 = "|na|";}
			if( $('#selectpeops-div').length ){
			var selectpeops = $("#selectpeops").val();
			var selectpeopsname = $("#selectpeops").attr('placeholder');
			}else{var selectpeops="|na|";
			var selectpeopsname = "|na|";}
			if( $('#selectrtype-div').length ){
			var selectrtype = $("#selectrtype").val();
			var selectrtypename = $("#selectrtype").attr('placeholder');
			}else{var selectrtype="|na|";
			var selectrtypename = "|na|";}
			if( $('#gender-div').length ){
			var gender = $("input:radio[name ='gender']:checked").val();
			}else{var gender="|na|";}
			if( $('#subject-div').length ){
			var subject=$("#subject").val();
			}else{var subject="|na|";}
			if( $('#address1-div').length ){
			var address1=$("#address1").val();
			}else{var address1="|na|";}
			if( $('#address2-div').length ){
			var address2=$("#address2").val();
			}else{var address2="|na|";}
 			if( $('#city-div').length ){
			var city=$("#city").val();
			}else{var city="|na|";}
 			if( $('#county-div').length ){
			var county=$("#county").val();
			}else{var county="|na|";}
 			if( $('#country-div').length ){
			var country=$("#country").val();
			}else{var country="|na|";}
 			if( $('#postcode-div').length ){
			var postcode=$("#postcode").val();
			}else{var postcode="|na|";}
 			if( $('#company-div').length ){
			var company=$("#company").val();
			}else{var company="|na|";}
 			if( $('#mobile-div').length ){
			var mobile=$("#mobile").val();
			}else{var mobile="|na|";}
 			if( $('#copyto').length ){
			var copyto=$("#copyto").html();
			}else{var copyto="|na|";}
 			if( $('#websiteurl').length ){
			var websiteurl=$("#websiteurl").val();
			}else{var websiteurl="|na|";}
 			if( $('#facebookurl').length ){
			var facebookurl=$("#facebookurl").val();
			}else{var facebookurl="|na|";}
 			if( $('#linkedinurl').length ){
			var linkedinurl=$("#linkedinurl").val();
			}else{var linkedinurl="|na|";}
			var name = $("input#name").val();
            var email = $("input#email").val();
            var phone = $("input#phone").val();
            var message = $("textarea#message").val();
            var firstName = name;
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
			document.getElementById("submitbutton").style.visibility="hidden";
			$('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>" + firstName + ", Please wait while your message is sent. May take a few seconds. Please be patient!");
                    $('#success > .alert-danger').append('</div>');
            $.ajax({
                url: "assets/rspluginuadv/mail-resuadv/contact_meuadv.php",
                type: "POST",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                    selectdate: selectdate,
					selectdatename:selectdatename,
                    selectdate2: selectdate2,
					selectdatename2:selectdatename2,
					selectpeops:selectpeops,
					selectpeopsname:selectpeopsname,
					selectrtype:selectrtype,
					selectrtypename:selectrtypename,
					sendto: sendto,
					subject: subject,
					address1: address1,
					address2: address2,
					city: city,
					county: county,
					country: country,
					postcode: postcode,
					mobile: mobile,
					company: company,
					gender: gender,
					copyto: copyto,
					thefiles: thefiles,
					websiteurl: websiteurl,
					facebookurl, facebookurl,
					linkedinurl, linkedinurl,
					captcha: grecaptcha.getResponse()
                },
                cache: false,
                success: function(data) {
                    var data1=JSON.parse(data);
					data2=data1.response;
					if(data2=="2"){
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');
                    $('#contactForm').trigger("reset");
					$('#cancelclose').html('Close');
					$('#contactForm').trigger("reset");
					}
					else if (data2=="8"){
					$('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>Captcha incorrect - try again! </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');
                    //$('#contactForm').trigger("reset");
					document.getElementById("submitbutton").style.visibility="visible";
					}
					else if (data2=="5"){
					$('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>CURL Is NOT Installed! </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');
                    //$('#contactForm').trigger("reset");
					document.getElementById("submitbutton").style.visibility="visible";
					}
					else if (data2=="7"){
					$('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>Send Mail failed! </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');
                    //$('#contactForm').trigger("reset");
					document.getElementById("submitbutton").style.visibility="visible";
					}
					else{
					$('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>Missing Inputs - try again! </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');
                    //$('#contactForm').trigger("reset");
					document.getElementById("submitbutton").style.visibility="visible";
					}
                },
                error: function() {
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that our mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    $('#contactForm').trigger("reset");
                },
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


$('#name').focus(function() {
    $('#success').html('');
});
