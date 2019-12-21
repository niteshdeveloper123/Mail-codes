@extends('layouts.app')
@section('title', 'Contact')
@section('content')



		<!-- Content
		============================================= -->
		<section id="content" class="clear-both">

			<a id="popUpSuccess" style="display:none;" href="#" class="btn btn-success" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Thanks. We will get back to you soon." onclick="SEMICOLON.widget.notifications(this); return false;">Show Success</a>

			<div class="content-wrap nopadding">
			
				<!----====Contact Banner====---->
				
				<div class="container-fluid nopadding">
				
					<div class="contact-banner">
					
						<div class="about-banner">
					
							<div class="contact-banner-content">
							
								<h1 class="common-banner-heading white">Get in Touch</h1>
								
								<!--<p class="white">Com First is a New Delhi based niche consulting organization that specializes in regulation,policy and development. get in touch how we can help you.</p>
								
								<a class="web-btn web-btn-white" href="#">Get in touch</a>-->
							
							</div>
						
						</div>
					
					</div>
				
				</div>
				
				
				<!----====Contact Form====---->
				
				<div class="contact-form-parent">
					
					<div class="container">
						<div id="cover-spin"></div> 
						<div class="contact-form-total row nomargin">
					
						<div class="col-xl-6 col-lg-6 col-md-6 nopadding">
						
							<div class="contact-details">
							
								<h2 class="common-heading1">Office</h2>
								
								<div class="contact-details-parent">
							
									<div class="contact-details-content">
									
										<p><i class="icon-map-marker2"></i> New Delhi, India</p>
										
										<a href="mailto:info@comfirstindia.com"><i class="icon-paper-plane"></i> info@comfirstindia.com</a>
										
										<a href="tell:+91-9810042969"><i class="icon-call"></i> +91-9810042969</a>
									
									</div>
								
								</div>
							
							</div>
						
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-6 nopadding">
						
							<form id="contactForm" class="contact-form-details" method="POST" action="#">
								 {{ csrf_field() }}
								<h2 class="common-heading1 white">Contact us</h2>
								
								<div class="contact-input-area">
								
									<div class="form-group">
									
										<input type="text" name="name" class="form-control common-input common-placeholder" placeholder="name">
										<span class="required-alert"></span> 
									</div>
									
									<div class="form-group">
									
										<input type="email" name="email" class="form-control common-input common-placeholder" placeholder="email">
										<span class="required-alert"></span> 
									</div>
									
									<div class="form-group">
									
										<input type="text" name="subject" class="form-control common-input common-placeholder" placeholder="subject">
										<span class="required-alert"></span> 
									</div>
									
									<div class="form-group">
									
										<textarea class="form-control common-textarea common-placeholder" cols="7" placeholder="message" name="msg"></textarea>
										<span class="required-alert"></span> 
									</div>

									<div class="g-recaptcha" data-sitekey="6LeE-qwUAAAAAEH_nsGJypJ6JE69kuZTSoW2-CQX"></div>
									<input type="hidden" name="gresponse" id="gresponse" value="">
									
									<input type="submit" class="web-btn web-btn-white" value="submit">
								
								</div>
							
							</form>


							
						
						</div>
					
						</div>
						
					</div>
				
				</div>
			

			</div>

		</section><!-- #content end -->
@endsection

@push('scripts')
<script type="text/javascript">
    $("#contactForm").validate({
        rules:{
            name:{
                required: true,
            },
            email:{
                required: true,
                email: true
            },
            phone:{
                required: true,
            },
            msg: {
                required:true,
            }            
        },
        errorPlacement: function(){
            return false;  // suppresses error message text
        },
        submitHandler: function(form) {
        	// alert('djj');
            var captchResponse = $('#g-recaptcha-response').val();
            $('#gresponse').val(captchResponse);
            if(captchResponse.length == 0 )
            {
                return false;
            }
            else 
            {
                //form.submit();

                $('#cover-spin').show(0);
                if($('input[name="name"]').val()=='' || $('input[name="email"]').val()==''){
                    $('#cover-spin').hide(0);
                    // return false;
                }

                $.ajax({
                    cache: false,
                    url: "{{ route('mail') }}",
                    type: "POST",
                    data:  $('#contactForm').serialize(),
                    // dataType: 'json',
                    success: function(data){

                    	console.log(data);
                        if(data=='invalid'){
                            console.log(data);
                            }
                            else{
                                $("#contactForm")[0].reset();
                                $('#cover-spin').hide(0);
                                $('#popUpSuccess').click();
                                // console.log(data);
                                 
                            }
                        },
                     error: function(e){
                         
                     }          
                });
                
                
            }
            
            
        }
    });
    
</script>
@endpush