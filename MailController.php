<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostPublished;
use Redirect;
use Session;
// use Storage;
class MailController extends Controller
{
    public function sendMail(Request $req) 
    {
    	// Storage::put('file.txt', 'Hello World');
    	$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
		    'secret'   => '6LeE-qwUAAAAAOIbEbfnwpOgrObS6Y726Ni_lC24',
		    'response' => $req->gresponse,
		]));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);

		curl_close($ch);

		$response = @json_decode($data);

		if ($response && $response->success)
		{
	    	$name = $req->name;
	    	$email = $req->email;
	    	$subject = $req->subject;
	    	$meg = $req->msg;

	    	$validatedData = $req->validate([
	        'name' => 'required',
	        'msg' => 'required',
	        'email' => 'required',
	        'subject' => 'required',
	    	]);

	    	$message = "<table border='0' cellspacing='0' cellpadding='0'>
		   					<tr>
							  	<td><b>Name:</b></td>
							    <td>".$name."</td>
							</tr>
							
						   	<tr>
						  		<td><b>E-mail:</b></td>
						    	<td>".$email."</td>
						  	</tr> 
		 
                            <tr>
						  		<td><b>Subject:</b></td>
						    	<td>".$subject."</td>
						  	</tr> 
		 
						  	<tr>
						    	<td><b>Message: </b></td>
						    	<td>".$meg."</td>
						  	</tr>
	  					</table>
					";
	    	
	    	$url = 'https://api.sendgrid.com/';
			$user = 'comfirstindia';
			$pass = 'Fbd.121010';
			$admin_to = 'info@comfirstindia.com'; 

			$json_string = array(

			  'to' => array(
			    $admin_to
			  ),
			  'category' => 'Contact Us'
			);


			$params = array(
			    'api_user'  => $user,
			    'api_key'   => $pass,
			    'x-smtpapi' => json_encode($json_string),
			    'to'        => $admin_to,
			    'subject'   => 'Enquiry from Nutri Swath website',
			    'html'      => $message,
			    'from'      => 'debalina41karmakar@gmail.com'
			  );


			$request =  $url.'api/mail.send.json';

			// Generate curl request
			$session = curl_init($request);
			// Tell curl to use HTTP POST
			curl_setopt ($session, CURLOPT_POST, true);
			// Tell curl that this is the body of the POST
			curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
			// Tell curl not to return headers, but do return the response
			curl_setopt($session, CURLOPT_HEADER, false);
			// Tell PHP not to use SSLv3 (instead opting for TLS)
			curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

			// obtain response
			$response = curl_exec($session);
			curl_close($session);

			// // print everything out
			print_r($response);

			// return Session::put('success', 'Mail is sent successfully!!');

	    }
	    else
	    {

	    }
	}
}
