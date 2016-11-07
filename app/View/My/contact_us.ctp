 <script src="<?php echo ABSOLUTE_URL;?>/vendor/jquery/jquery.min.js"></script>
<body>
	<div class="container page-heading" style="margin-top:40px;">
		<div class="row col-md-12 col-xs-12 padding-xs-0">
			<div class="col-xs-12 col-md-12 padding-top-10 margin-top-7">
				<div class="visible-md visible-lg visible-sm margin-top-15 text-white well">
					<h3><strong>Contact Us</strong></h3>
				</div>
        <div id="contacts" class="contaier margin-top-30 drop-shadow visible-xs row">
          <div class="well margin-bottom-0"><h3 class="text-info">Contact Us</h3></div>
        </div>
				<div class="margin-top-15  text-center">
					<h4>
						<b>We'd like to hear from you. Drop in your comments & queries and the NextStep team will get back to you</b>
					</h4>
					<br>
				</div>
				
				
				
				<div id="contacts" class="row margin-top-15 text-white well widthmin">
                  <div class="col-md-10  col-md-offset-1 margin-bottom-30 margin-top-30 mobile drop-shadow">
                  <div class="margin-top-30 margin-bottom-30">
                      <form id="contactUsForm" method="POST" action="javascript:void(0);" data-toggle="validator" >
                              <div class="form-group control-group controls">
                                  <label for="Name" class="control-label">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" required="" title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group control-group controls">
                                  <label for="email" class="control-label" >Email</label>
                                  <input type="text" class="form-control" id="email" name="email" title="Please enter you username" placeholder="example@gmail.com" required="">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="form-group control-group controls">
                                  <label for="mobile" class="control-label">Mobile</label>
                                  <input type="integer" class="form-control" id="mobile" name="mobile" value="" required="" title="Please enter your mobile number">
                                  <span class="help-block"></span>
                              </div>
                            <div class="form-group control-group controls">
                                  <label for="comments" class="control-label">Comments or Inquiry</label>
                                  <textarea type="integer" class="form-control" id="comments" name="comments" value="" required="" title="Please enter your Comments or Inquiry"></textarea>
                                  <span class="help-block"></span>
                              </div>
                             
                              <button type="submit" class="btn btn-success btn-block">Submit</button>
                          </form>
                          <div id="respoce" class="hidden well">
                            <div id="responceDiv">
                              <h3></h3>
                            </div>
                          </div>
                      </div>

                  </div>
        </div>
              
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	 $(document).ready(function () {
    $("#mainNav").css('background-color','#222222');
	 	<?php if(empty($message)) { ?>
			$("#contacts").removeClass('hidden')
		<?php } ?>
        ABSOLUTE_URL = "<?php echo ABSOLUTE_URL;?>";        
        $("#contactUsForm").bootstrapValidator({
            live: false,
            trigger: 'blur',
            fields: {
                "Name": {
                    validators: {
                        notEmpty: {
                            enabled: true,
                            message: "Please enter your complete name"
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'Please enter your name in valid characters'
                        },
                        stringLength: {
                            enabled: true,
                            min: 1,
                            max: 40,
                            message: 'Please enter your complete name'
                        }
                    }
                },
                "email": {
                    message: "Please Enter emailid",
                   
                    validators: {
                        notEmpty: {
                            enabled: true,
                            message: 'Please enter an E-mail address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid E-mail address'
                        }
                    }
                },
                "mobile": {
                    message: "Enter 10 digit phone number",
                    validators: {
                        notEmpty: {
                            message: 'Enter mobile number'
                        },
                        callback: {
                            message: 'Enter a valid mobile number',
                            callback: function (value, validator, $field) {

                                if (value === '') {
                                    return(true);
                                }
                                myString = value.replace(/ /g, '');
                               if (((myString.length == 10))) {
                                    return {
                                        valid: true,
                                    };
                                } 
                                else {
                                    return {
                                        valid: false,
                                        message: 'Enter a valid mobile number'
                                    };
                                }
                                return {
                                    valid: false,
                                    message: 'Enter a valid mobile number'
                                };
                            }
                        }//END CALL BACK
                    }
                }
            }

        }).on('success.form.bv',function(e){
        	e.preventDefault();
        	$.ajax({
        		type: "POST",
        		url: "<?php echo ABSOLUTE_URL;?>/my/submitLead",
        		data : $("#contactUsForm").serialize(true),
        		success:function( data ){
              if (data.hasError === true) {
                  $('#contactUsForm').addClass('hidden');
                  $("#respoce").removeClass('hidden');
                  $("#responceDiv").removeClass('text-success').addClass('text-danger');
                  $("#respoce h3").append('Something went wrong Please try again');

              } else {
                  $('#contactUsForm').addClass('hidden');
                  $("#respoce").removeClass('hidden');
                  $("#responceDiv").removeClass('text-danger').addClass('text-success');
                  $("#respoce h3").append('Thank you we will contact you shortly');
              }
            },
        		error:function(request, status, error){
        			alert("Something went wrong");
        		}
        	});
        });
    });
</script>