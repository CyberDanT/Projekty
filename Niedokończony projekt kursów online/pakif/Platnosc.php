<?php
	include_once('head.php');
	head();
	
	//echo $_POST['name'];
	//echo $_POST['lastname'];
	//echo $_POST['email'];
	//echo $_POST['phone'];
	//	echo $_SESSION['cena'].'<br>';
	//	echo $_SESSION['ids']; 
	
	unset($_SESSION['bad']);
	$_SESSION['bad'] = '<br>';
	
	if(isset($_POST['name'])){
		if(!preg_match('#^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]*$#is', $_POST['name'])){
			$_SESSION['bad'] = $_SESSION['bad'].'Imię musi się składać z polskich znaków, bez znaków specjalnych<br>';
		}
	}else{
		$_SESSION['bad'] = $_SESSION['bad'].'Wymagane jest podanie imiona / imion<br>';
	}
	
	if(isset($_POST['lastname'])){
		if(!preg_match('#^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]*$#is', $_POST['lastname'])){
			$_SESSION['bad'] = $_SESSION['bad'].'Nazwisko musi się składać z polskich znaków, bez znaków specjalnych<br>';
		}
	}else{
		$_SESSION['bad'] = $_SESSION['bad'].'Wymagane jest podanie nazwiska<br>';
	}
	
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$email1 = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($email1, FILTER_VALIDATE_EMAIL) == false) || ($email != $email1)){
		 $_SESSION['bad'] = $_SESSION['bad'].'Podany adres email jest błędny<br>';
		}
	}else{
		$_SESSION['bad'] = $_SESSION['bad'].'Wymagane jest podanie adresu email<br>';
	}
	
	if(isset($_POST['phone'])){
		if(!preg_match('#^[\+\s0-9\-_]{3,20}$#', $_POST['phone'])){
			$_SESSION['bad'] = $_SESSION['bad'].'Podany numer telefonu jest nieprawidłowy, prawidłowy format: +48 123456789<br>';
		}
	}else{
		$_SESSION['bad'] = $_SESSION['bad'].'Wymagane jest podanie nazwiska<br>';
	}
	
	if(!isset($_POST['checkbox'])){
		$_SESSION['bad'] = $_SESSION['bad'].'Wymagana jest akceptacja regulaminów';
	}
	
	
?>
		<title>Płatność</title>
	</head>
	

    <?php
		include_once('header.php');
		headerwrapper();
	?>
	
	<main role="main" class="flex-shrink-0" style="margin-top: -250px;">		
		<div class="container">
			<?php						

				if($_SESSION['bad'] != '<br>'){
					$_SESSION['formname'] = $_POST['name'];
					$_SESSION['formlastname'] = $_POST['lastname'];
					$_SESSION['formemail'] = $_POST['email'];
					$_SESSION['formphone'] = $_POST['phone'];
					$_SESSION['platnosc'] = 1;
					header('Location: Dane-do-platnosci.php');
				}else{
					if(isset($_SESSION['cena'])){
						if(isset($_SESSION['ids'])){
							?>
							<h4>Sprawdź spójność danych i akceptuj płatność</h4>
							<br><br>

							<p style="font-size: 20px;"><?php echo $_POST['name'].' '.$_POST['lastname'].'<br>'; ?></p>
							<p><span class="icon-envelope"> </span> <?php echo $_POST['email'].'<br>'; ?>
							<span class="icon-phone"> </span> <?php echo $_POST['phone'].'<br>'; ?></p><br><br>
							<p>Po dokonaniu płatności sprawdź swój adres email</p>
							
							<br><br>
							<h3 style="text-left"><span style="color: #0077be; font-size:35px;">||</span> Kursy otrzymane po zakupie</h3>
							
							<?php
		
							foreach($_SESSION['koszyk'] as $key=>$val) {
								echo '
									<div class="col-lg-12" style="margin-top: 25px; padding-bottom: 25px;">
										<div class="d-sm-flex listing">
											  <img src="obrazy/'.$val['obrazek'].'" class="img d-block img-fluid img-responsive" style="background-image: url(\'obrazy/'.$val['obrazek'].'\');"/>
											  <div style="min-height: 170px;">
												<h4>'.$val['nazwa'].'</h4>
											  </div>
										</div>
										<div style="text-align: right;">
											Cena kursu <b>'.$val['cena'].' PLN</b>
										</div>
									</div>
									<hr>
									';
								}
								echo '<div style="text-align: right; padding-top: 50px; padding-bottom: 50px;">Łączna cena kursów <b>'.$_SESSION['cena'].' PLN</b></div>';
								
								
								
								
								
								################### https://www.dotpay.pl/developer/doc/api_payment/   ######################################################################
							#
							#	Exemplary function (PHP) generating  the correct payment redirection (POST / GET) to Dotpay payment api with parametr 'chk' (checksum).
							#	You enter the payment data in the parameter: $ParametersArray.
							#
							#	In addition, the examplary includes the use of data for the Multimerchant service ($MultiMerchantList)
							#	and some payment channels that require additional data, e.g. a delivery address ($customer).
							#	You do not need to use them if you do not use these features.
							#
							#	Dotpay Sp. z o.o.
							#	Tech Customer Service: tech@dotpay.pl
							#   Date: 2019-04-15
							#
							##############################################################################################################################################


							/** ---------  BASE CONFIG  ---------  **/

							// Your Dotpay ID shop (6 digits)
								$DotpayId = "======";

							// PIN for Your Dotpay ID (copy this from your dotpay panel carefully, without space)
								$DotpayPin = "============================";

							// Dotpay Environment, available: "test" or "production"
								$Environment = "production";

							//Redirection method: POST or GET ; recommended method is "POST"
								$RedirectionMethod = "POST";

							/**  ---------  end config  ---------  **/


							// Do not remove this!
							$MultiMerchantList = array(); //optional data
							$customer = null;  //optional data


							## CALCULATE CHECKSUM - CHK

							function GenerateChk($DotpayId, $DotpayPin, $Environment, $RedirectionMethod, $ParametersArray, $MultiMerchantList, $customer_base64)

							{
								$ParametersArray['id'] = $DotpayId;
								$ParametersArray['customer'] = $customer_base64;

								$chk =   $DotpayPin.
								(isset($ParametersArray['api_version']) ? $ParametersArray['api_version'] : null).
								(isset($ParametersArray['lang']) ? $ParametersArray['lang'] : null).
								(isset($ParametersArray['id']) ? $ParametersArray['id'] : null).
								(isset($ParametersArray['pid']) ? $ParametersArray['pid'] : null).
								(isset($ParametersArray['amount']) ? $ParametersArray['amount'] : null).
								(isset($ParametersArray['currency']) ? $ParametersArray['currency'] : null).
								(isset($ParametersArray['description']) ? $ParametersArray['description'] : null).
								(isset($ParametersArray['control']) ? $ParametersArray['control'] : null).
								(isset($ParametersArray['channel']) ? $ParametersArray['channel'] : null).
								(isset($ParametersArray['credit_card_brand']) ? $ParametersArray['credit_card_brand'] : null).
								(isset($ParametersArray['ch_lock']) ? $ParametersArray['ch_lock'] : null).
								(isset($ParametersArray['channel_groups']) ? $ParametersArray['channel_groups'] : null).
								(isset($ParametersArray['onlinetransfer']) ? $ParametersArray['onlinetransfer'] : null).
								(isset($ParametersArray['url']) ? $ParametersArray['url'] : null).
								(isset($ParametersArray['type']) ? $ParametersArray['type'] : null).
								(isset($ParametersArray['buttontext']) ? $ParametersArray['buttontext'] : null).
								(isset($ParametersArray['urlc']) ? $ParametersArray['urlc'] : null).
								(isset($ParametersArray['firstname']) ? $ParametersArray['firstname'] : null).
								(isset($ParametersArray['lastname']) ? $ParametersArray['lastname'] : null).
								(isset($ParametersArray['email']) ? $ParametersArray['email'] : null).
								(isset($ParametersArray['street']) ? $ParametersArray['street'] : null).
								(isset($ParametersArray['street_n1']) ? $ParametersArray['street_n1'] : null).
								(isset($ParametersArray['street_n2']) ? $ParametersArray['street_n2'] : null).
								(isset($ParametersArray['state']) ? $ParametersArray['state'] : null).
								(isset($ParametersArray['addr3']) ? $ParametersArray['addr3'] : null).
								(isset($ParametersArray['city']) ? $ParametersArray['city'] : null).
								(isset($ParametersArray['postcode']) ? $ParametersArray['postcode'] : null).
								(isset($ParametersArray['phone']) ? $ParametersArray['phone'] : null).
								(isset($ParametersArray['country']) ? $ParametersArray['country'] : null).
								(isset($ParametersArray['code']) ? $ParametersArray['code'] : null).
								(isset($ParametersArray['p_info']) ? $ParametersArray['p_info'] : null).
								(isset($ParametersArray['p_email']) ? $ParametersArray['p_email'] : null).
								(isset($ParametersArray['n_email']) ? $ParametersArray['n_email'] : null).
								(isset($ParametersArray['expiration_date']) ? $ParametersArray['expiration_date'] : null).
								(isset($ParametersArray['deladdr']) ? $ParametersArray['deladdr'] : null).
								(isset($ParametersArray['recipient_account_number']) ? $ParametersArray['recipient_account_number'] : null).
								(isset($ParametersArray['recipient_company']) ? $ParametersArray['recipient_company'] : null).
								(isset($ParametersArray['recipient_first_name']) ? $ParametersArray['recipient_first_name'] : null).
								(isset($ParametersArray['recipient_last_name']) ? $ParametersArray['recipient_last_name'] : null).
								(isset($ParametersArray['recipient_address_street']) ? $ParametersArray['recipient_address_street'] : null).
								(isset($ParametersArray['recipient_address_building']) ? $ParametersArray['recipient_address_building'] : null).
								(isset($ParametersArray['recipient_address_apartment']) ? $ParametersArray['recipient_address_apartment'] : null).
								(isset($ParametersArray['recipient_address_postcode']) ? $ParametersArray['recipient_address_postcode'] : null).
								(isset($ParametersArray['recipient_address_city']) ? $ParametersArray['recipient_address_city'] : null).
								(isset($ParametersArray['application']) ? $ParametersArray['application'] : null).
								(isset($ParametersArray['application_version']) ? $ParametersArray['application_version'] : null).
								(isset($ParametersArray['warranty']) ? $ParametersArray['warranty'] : null).
								(isset($ParametersArray['bylaw']) ? $ParametersArray['bylaw'] : null).
								(isset($ParametersArray['personal_data']) ? $ParametersArray['personal_data'] : null).
								(isset($ParametersArray['credit_card_number']) ? $ParametersArray['credit_card_number'] : null).
								(isset($ParametersArray['credit_card_expiration_date_year']) ? $ParametersArray['credit_card_expiration_date_year'] : null).
								(isset($ParametersArray['credit_card_expiration_date_month']) ? $ParametersArray['credit_card_expiration_date_month'] : null).
								(isset($ParametersArray['credit_card_security_code']) ? $ParametersArray['credit_card_security_code'] : null).
								(isset($ParametersArray['credit_card_store']) ? $ParametersArray['credit_card_store'] : null).
								(isset($ParametersArray['credit_card_store_security_code']) ? $ParametersArray['credit_card_store_security_code'] : null).
								(isset($ParametersArray['credit_card_customer_id']) ? $ParametersArray['credit_card_customer_id'] : null).
								(isset($ParametersArray['credit_card_id']) ? $ParametersArray['credit_card_id'] : null).
								(isset($ParametersArray['blik_code']) ? $ParametersArray['blik_code'] : null).
								(isset($ParametersArray['credit_card_registration']) ? $ParametersArray['credit_card_registration'] : null).
								(isset($ParametersArray['surcharge_amount']) ? $ParametersArray['surcharge_amount'] : null).
								(isset($ParametersArray['surcharge']) ? $ParametersArray['surcharge'] : null).
								(isset($ParametersArray['surcharge']) ? $ParametersArray['surcharge'] : null).
								(isset($ParametersArray['ignore_last_payment_channel']) ? $ParametersArray['ignore_last_payment_channel'] : null).
								(isset($ParametersArray['vco_call_id']) ? $ParametersArray['vco_call_id'] : null).
								(isset($ParametersArray['vco_update_order_info']) ? $ParametersArray['vco_update_order_info'] : null).
								(isset($ParametersArray['vco_subtotal']) ? $ParametersArray['vco_subtotal'] : null).
								(isset($ParametersArray['vco_shipping_handling']) ? $ParametersArray['vco_shipping_handling'] : null).
								(isset($ParametersArray['vco_tax']) ? $ParametersArray['vco_tax'] : null).
								(isset($ParametersArray['vco_discount']) ? $ParametersArray['vco_discount'] : null).
								(isset($ParametersArray['vco_gift_wrap']) ? $ParametersArray['vco_gift_wrap'] : null).
								(isset($ParametersArray['vco_misc']) ? $ParametersArray['vco_misc'] : null).
								(isset($ParametersArray['vco_promo_code']) ? $ParametersArray['vco_promo_code'] : null).
								(isset($ParametersArray['credit_card_security_code_required']) ? $ParametersArray['credit_card_security_code_required'] : null).
								(isset($ParametersArray['credit_card_operation_type']) ? $ParametersArray['credit_card_operation_type'] : null).
								(isset($ParametersArray['credit_card_avs']) ? $ParametersArray['credit_card_avs'] : null).
								(isset($ParametersArray['credit_card_threeds']) ? $ParametersArray['credit_card_threeds'] : null).
								(isset($ParametersArray['customer']) ? $ParametersArray['customer'] : null).
								(isset($ParametersArray['gp_token']) ? $ParametersArray['gp_token'] : null).
								(isset($ParametersArray['blik_refusenopayid']) ? $ParametersArray['blik_refusenopayid'] : null).
								(isset($ParametersArray['auto_reject_date']) ? $ParametersArray['auto_reject_date'] : null).    
								(isset($ParametersArray['ap_token']) ? $ParametersArray['ap_token'] : null);

								foreach ($MultiMerchantList as $item) {
									foreach ($item as $key => $value) {
										$chk =   $chk.
							(isset($value) ? $value : null);
									}
								}
								return $chk;
							}



							## GENERATE FORM TO DOTPAY

							function GenerateChkDotpayRedirection($DotpayId, $DotpayPin, $Environment, $RedirectionMethod, $ParametersArray, $MultiMerchantList, $customer_base64)
							{
								$ParametersArray['id'] = $DotpayId;
								$ChkParametersChain = GenerateChk($DotpayId, $DotpayPin, $Environment, $RedirectionMethod, $ParametersArray, $MultiMerchantList, $customer_base64);


								$ChkValue = hash('sha256', $ChkParametersChain);

								if ($Environment == 'production') {
									$EnvironmentAddress = 'https://ssl.dotpay.pl/t2/';
								} elseif ($Environment == 'test') {
									$EnvironmentAddress = 'https://ssl.dotpay.pl/test_payment/';
								}

								if ($RedirectionMethod == 'POST') {
									$RedirectionCode = '<form action="'.$EnvironmentAddress.'" method="POST" id="dotpay_redirection_form" accept-charset="UTF-8">'.PHP_EOL;

									foreach ($ParametersArray as $key => $value) {
										$RedirectionCode .= "\t".'<input name="'.$key.'" value="'.$value.'" type="hidden"/>'.PHP_EOL;
									}

									if(isset($customer_base64)) {
										$RedirectionCode .= "\t".'<input name="customer" value="'.$customer_base64.'" type="hidden"/>'.PHP_EOL;
									}

									foreach ($MultiMerchantList as $item) {
										foreach ($item as $key => $value) {
											$RedirectionCode .= "\t".'<input name="'.$key.'" value="'.$value.'" type="hidden"/>'.PHP_EOL;
										}
									}

									$RedirectionCode .= "\t".'<input name="chk" value="'.$ChkValue.'" type="hidden"/>'.PHP_EOL;
									$RedirectionCode .= '</form>'.PHP_EOL.'<button class="btn btn-primary btn-block rounded" id="dotpay_redirection_button" type="submit" form="dotpay_redirection_form" style="margin-bottom: 100px; margin-top: 50px;" value="Submit">Potwierdź i zapłać</button>'.PHP_EOL;

									return $RedirectionCode;

								} elseif ($RedirectionMethod == 'GET') {
									$RedirectionCode = $EnvironmentAddress.'?';

									foreach ($ParametersArray as $key => $value) {
										$RedirectionCode .= $key.'='.rawurlencode($value).'&';
									}

									if(isset($customer_base64)) {
										$RedirectionCode .= 'customer='.$customer_base64.'&';
									}

									foreach ($MultiMerchantList as $item) {
										foreach ($item as $key => $value) {
											$RedirectionCode .= $key.'='.rawurlencode($value).'&';
										}
									}

									$RedirectionCode .= 'chk='.$ChkValue;

									return '<a href="'.$RedirectionCode.'">Go to Pay</a><br>link:<br>'.$RedirectionCode;
								}
							}





							// ** -----------------------   SAMPLE DATA ------------------------- **/



							/*  ## SAMPLE PAYMENT DATA IN ##  */
								// Note! You can use more parameters if You need
								// You must give at least: 'amount', 'currency', 'description' (and of course ID and PIN in the configuration of this script)
								// see more: https://www.dotpay.pl/developer/doc/api_payment/en/index.html#tabela-1-podstawowe-parametry-przesylane-do-serwisu-dotpay
								// and: https://www.dotpay.pl/developer/doc/api_payment/en/index.html#tabela-2-dodatkowe-parametry-przesylane-do-serwisu-dotpay

							// ------
							$ParametersArray = array(
								"api_version" => "dev",
								"amount" => ''.$_SESSION['cena'].'',
								"currency" => "PLN",
								"description" => "Zaplata za kursy dla - ".$_POST['name']." ".$_POST['lastname']." ",
								"url" => "http://pakif.pl/",
								"type" => "4",
								"channel_groups" => "T",
								"buttontext" => "Powrót do Pakif.pl",
								"urlc" => "http://pakif.pl/Zakonczenie-platnosci.php",
								"control" => ''.$_SESSION['ids'].'',
								"firstname" => ''.$_POST['name'].'',
								"lastname" => ''.$_POST['lastname'].'',
								"email" => ''.$_POST['email'].'',
								"street" => "None",
								"street_n1" => "0",
								"city" => "None",
								"postcode" => "12-345",
								"phone" => ''.$_POST['phone'].'',
								"country" => "POL",
								"ignore_last_payment_channel" => "true"
							);



							/*  ### SAMPLE Multimerchant DATA IN (3 accounts 'child' type ) - optional  ###
									 You can remove it if You don't need it
									 see more: https://www.dotpay.pl/developer/doc/api_payment/en/index.html#platnosc-dzielona-multimerchant-pasaz
							*/

							// ------ uncomment if you need:

							/*
								$MultiMerchantList = array(
									$MultiMerchant1 = array(
										"id1" => "123456",
										"amount1" => "10.00",
										"currency1" => "PLN",
										"description1" => "description1",
										"control1" => "control1",
									) ,
									$MultiMerchant2 = array(
										"id2" => "234561",
										"amount2" => "60.00",
										"currency2" => "PLN",
										"description2" => "description2",
										"control2" => "control2",
									) ,
									$MultiMerchant3 = array(
										"id3" => "234562",
										"amount3" => "30.00",
										"currency3" => "PLN",
										"description3" => "description3",
										"control3" => "control3",
									)
								);

							*/
							// ------


							// ** -----------------------   SAMPLE DATA  end ------------------------- **/


							if (empty($customer) || !isset($customer['payer']) || !isset($customer['order']['delivery_address'])) {
								$customer_base64 = null;
							} else {
								$customer_base64 = base64_encode(json_encode($customer));
							}



							##  get form (POST method) or payment link (GET method)
							##  ("Dotpay ID","PIN","[test|production]","[POST|GET]","payment data","Multimerchant data", "additional customer data")

							echo GenerateChkDotpayRedirection($DotpayId, $DotpayPin, $Environment, $RedirectionMethod , $ParametersArray, $MultiMerchantList, $customer_base64);
								
								
								
								
								
								
								
								
								
								
							
						}else{
							$_SESSION['bad'] = $_SESSION['bad'].'W koszyku nie ma żadnych kursów';
							header('Location: Dane-do-platnosci.php');
						}
					}else{
						$_SESSION['bad'] = $_SESSION['bad'].'W koszyku nie ma kursów';
						echo '<script>location.replace("Dane-do-platnosci.php")</script>';
					}
				}
			
			?>
			
		</div>
		
	</main>

	<?php
		include_once('footer.php');
		footer();
	?>