<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


?>
<!DOCTYPE html>
<html>
    <?php echo $this->element('header'); ?>
<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>

		</div>
		<div id="footer">
			 <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>8109342601</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:devr96@gmail.com">devr96@gmail.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?php echo ABSOLUTE_URL;?>/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo ABSOLUTE_URL;?>/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo ABSOLUTE_URL;?>/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo ABSOLUTE_URL;?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="<?php echo ABSOLUTE_URL;?>/js/bootstrapValidator.min.js"  type="text/javascript"></script>
    <!-- Theme JavaScript -->
    <script src="<?php echo ABSOLUTE_URL;?>/js/creative.min.js"></script>

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
<div id="lucyForm"  class="modal fade" role="dialog">
      <div class="modal-content modal-dialog">
          <div class="modal-header">
              <button id="close" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="">Please fill the details</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                  <div class="well">
                      <form id="lucy" method="POST" action="#"  data-toggle="validator" novalidate="novalidate">
                              <div class="form-group control-group">
                              <div class="form-group control-group">
                                  <label for="name" class="control-label">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="" required="" title="Please enter your name">
                                  <span class="help-block"></span>
                              </div>
                                  <label for="email" class="control-label" >Email</label>
                                  <input type="text" class="form-control" id="email" name="email" title="Please enter you Email" required="">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group control-group">
                                  <label for="contact" class="control-label">Contact Number</label>
                                  <input  class="form-control" id="contact" name="contact" value="" required="" title="Please enter contact number">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group control-group">
                                  <label for="enquiry" class="control-label">How can we help you? </label>
                                  <textarea class="form-control" id="enquiry" name="enquiry" value="" title="Please enter your querys "></textarea>
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit"   class="btn btn-default btn-primary">Submit</button>
                          </form>
                          <div id="responce" class="hidden">
                            <h3 id="message"></h3>
                          </div>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
<script type="text/javascript">
      $(document).ready(function () {
      
        ABSOLUTE_URL = "<?php echo ABSOLUTE_URL;?>";        
        $("#lucy").bootstrapValidator({
            live: false,
            trigger: 'blur',
            fields: {
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
                "name": {
                    message: "Please enter your name",
                    validators: {
                        notEmpty: {
                            enabled: true,
                            message: 'Please enter your name'
                        }
                    }
                },
                "contact": {
                    message: "Enter 10 digit phone number",
                    validators: {
                        notEmpty: {
                            message: 'Enter contact number'
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

        }) .on('success.form.bv', function(e) {
                    e.preventDefault();
                    $.ajax({
                        dataType: "JSON",
                        url: ABSOLUTE_URL + "/my/submitLead",
                        data: $('#lucy').serialize(),
                        type: "POST",
                        success: function(res) {
                            if (res.hasError === true) {
                                $('#lucy').addClass('hidden');
                                $("#responce").removeClass('hidden');
                                $("#message").removeClass('text-success').addClass('text-danger').append('Something went wrong Please try again');
                            } else {
                                $('#lucy').addClass('hidden');
                                $("#responce").removeClass('hidden');
                                $("#message").removeClass('text-danger').addClass('text-success').append('Thank you we will contact you shortly');
                            }
                        }
                    });
                });
         
    });
</script>