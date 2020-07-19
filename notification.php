<?php

	$clients = array(
	array("id" => "1", "phone_number" => "+998941234567", "mail" => "abdusattarov9@mail.ru"),
	array("id" => "2", "phone_number" => "+998940000000", "mail" => "somemail@mail.ru")
	);

	$products = array(
	array("id" => "1", "name" => "potato", "cost"=>"0.55"),
	array("id" => "2", "name" => "milk", "cost"=>"1.10")
	);
	$purchase_history = array();
	sendNotification($clients, $products, $purchase_history);
	function getInput(){
		$input = fgets(STDIN, 8);
		return $input;	
	}
	function sendNotification($clients, $products, $history){

	echo "****To send by email, Enter - 1\n****To send by sms, Enter - 2\n****To see history, Enter - 3\n****To end job, Enter - 4\n";
	$input = getInput();
	switch ($input) {
		case 1:
			echo "To which user\n";
			$length = count($clients);
			for($i=0; $i < $length; $i++){
				echo $i+1, "-", $clients[$i][mail], "\n";
			}
			$client_number = getInput();
			if($client_number > $length){
			echo "Plese enter available clients";
			getInput();
			}
			$to      = $clients[$client_number-1][mail];
			$subject = 'Purchase done:' . $products[0][name] . ' - ' . $products[0][cost] . ', ' . $products[1][name] . ' - ' . $products[1][cost];
			$message = 'Products';
			$headers = array(
    				'From' => 'khondamirbek@gmail.com',
  				'Reply-To' => 'khondamirbek@gmail.com',
    				'X-Mailer' => 'PHP/' . phpversion()
				);
			try {
				mail($to, $subject, $message, implode("\r\n", $headers));
				echo "Mail has been sent\n";
				array_push($history, $client_number-1);
				
			}catch(Exception $e){ 
				echo "Exception happened", $e->getMessage(), "\n";
			}
			sendNotification($clients, $products, $history);
		break;
		case 2:	
			echo "Email API is being connected\n";
			sendNotification($clients, $products, $history);
		break;
		case 3:
			echo "History of notifications - \n";
			for($k = 0; $k < count($history); $k++){
				echo $k+1, ". ", $clients[$history[$k]][mail], "\n";
			}
			sendNotification($clients, $products, $history);
		break;
		case 4:
			echo "Job finished\n";
		break;
		default:
			echo "Not defined input, Try new\n";
			sendNotification($clients, $products, $history);
			
		
	}
	}

?>