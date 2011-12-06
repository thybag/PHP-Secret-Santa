<?php
/**
 * PHP Secret Santa
 * A very simple PHP based Secret Santa Script.
 *
 * @Author Carl Saggs (2011)
 * @license MIT License
 */
 
//Very very basic email validation (basically, does it contain an '@')
function badEmailValidate($email){
	if(strpos($email,'@') != false) return true;
	return false;
}
//If valid data was sumbitted
if($_POST['count'] && $_POST['count'] > 0){

	$users = array();
	//Proccess Form
	for($c=0;$c<$_POST['count'];$c++){
		//Ensure both username and email were provided (and that email is .. sorta... valid)
		if(!empty($_POST['user_name_'.$c]) && !empty($_POST['user_email_'.$c]) && badEmailValidate($_POST['user_email_'.$c])){
			$users[] = array(
				'name'	=>	preg_replace('/[^a-zA-Z0-9]/i', "", $_POST['user_name_'.$c]),//Remove funny chars
				'email'	=>	$_POST['user_email_'.$c]
			);
		}
	}
	//Ensure some people actually entered the Secret Santa
	if(sizeof($users)<2) die("Only one valid user was detected. Please ensure you fill out the form fully.");
	//Get spend amount
	$amount = (int) $_POST['amount'];
	
	
	//Get Secret Santa Class
	require ('Santa.class.php');

	//Create Object and set values
	$santa = new SecretSanta();
	$santa->setAmount($amount);
	$santa->setTitle('Secret Santa');//Title of emails sent by tool
	$santa->setFrom('Santa','santa@myDomain.com');//Address emails claim to be sent from.

	//Run on $users, and show Success message on success
	if($santa->run($users)){
		echo 'Secret Santa emails have successfully been sent to the following email addresses:<br/>';
		$sent = $santa->getSentEmails();
		foreach($sent as $mail){
			echo $mail.'<br/>';
		}
	}
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Secret Santa</title>
		<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:500' rel='stylesheet' type='text/css'>
		<style type='text/css'>
			body {
				background-color:#222;
			}
			#container {
				border: solid #ccc 2px;
				background-color:#fff;
				width:680px;
				margin: 20px auto 2px;
			}
			.header {
				background-color:#A30027;
				padding:8px 12px;
				color:#fff;
				font-size:2.2em;
				font-family: 'Cabin Condensed', sans-serif;
			}
			.heading {
				width:300px;
				padding:2px 5px;
				float:left;
				
			}
			.block {
				margin:6px;
				border: solid #666 2px;
			}
			.block .header {
				font-size:1em;
				padding:5px;
			}
			.block .row {
				clear:left;
			}
			.block .row span {
				cursor:pointer;
			}
			.block .toprow {
				background-color:#f1f1f1;
				height:24px;
			}
			.block .row input, .block .row .seg {
				width:300px;
				border: solid 1px #f2f2f2;
				padding:5px;
				display:inline-block;
			}
			.right {
				text-align:right;
			}
			.block .row button{
				background-color:#f1f1f1;
				border:solid 1px #666;
				padding:4px;
				cursor:pointer;
			}
			.run{
				background-color:#f1f1f1;
				border:solid 1px #666;
				padding:4px;
				margin:6px;
				display:block;
				width:668px;
				cursor:pointer;
			}
			p {
				padding:2px 8px;
				margin:0px;
				font-size:0.9em;
			}
			.right_under {
				margin: 0px auto;
				text-align:right;
				width:676px;
				color:#555;
				font-size:0.7em;
			}
			.right_under a {color:#666;}
		</style>
		<script type='text/javascript'>
		
			var tmp_dom = null;
			var counter = 1;
			function addUser(){
				//Store tmp object for creation of more (if one isnt already stored)
				if(tmp_dom == null) tmp_dom = document.getElementById('insert_zone').children[0];
				
				//Create new node
				new_node = tmp_dom.cloneNode(true);
				//Blank inputs and update form ID's
				inputs = new_node.getElementsByTagName('input')
				for(var i=0; i<inputs.length; i++){
					inputs[i].value ='';
					inputs[i].name = inputs[i].name.slice(0, -1)+counter;
				}
				//Add new row
				document.getElementById('insert_zone').appendChild(new_node);
				//Update Counters
				counter++; document.getElementById('count').value = counter;
				//Stop form submitting
				return false;
			}
			function removeRow(me){
				//Store so we can add new ones (assumings its not already there)
				if(tmp_dom == null) tmp_dom = document.getElementById('insert_zone').children[0];
				document.getElementById('insert_zone').removeChild(me.parentNode);
			}
		</script>
	</head>
	<body>
		<div id='container'>
			<form method='post' action=''>
				<div class='header'>Online Secret Santa</div>
				<div class='block'>
					<div class='header'>People</div>
					<div class='toprow row'>
						<div class='heading'>Name</div>
						<div class='heading'>Email</div>
					</div>
					<div id='insert_zone'>
						<div class='row'>
							<input name='user_name_0' value='' />
							<input name='user_email_0' value='' />
							<span onclick='removeRow(this);'>[x]</span>
						</div>
					</div>
					<div class='row right'>
						<button onclick='return addUser();'>Add another User</button>
					</div>
				</div>
				<div class='block'>
					<div class='header'>Setup</div>
					<div class='row'>
						<div class='seg'>Amount to pay:</div>
						£<input name='amount' value='5'>
					</div>
				</div>
				<p>
				Please take care when filling out each persons email address as if its entered wrong they won't know who they have for secret santa.
				</p>
				<input type='hidden' id='count' name='count' value='0' />
			  
			  <input class='run' type='submit' value='Send!' onclick='confirm("Are you sure you want to send the secret santa emails now?")'/>
			</form>
			
		</div>
		<p class='right_under'>
			Created by <a href='http://userbag.co.uk' target='_blank'>Userbag.co.uk</a>
		</p>
	</body>
</html>