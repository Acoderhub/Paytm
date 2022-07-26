<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;


$paramList["CALLBACK_URL"] = "./pgResponse.php";
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //


//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>

body{
	background-color: white;
	color: white;
}

button{
	background-color: white;
	border: 2px solid gray;
	color: white;
	font-size: 1.3em;
	padding: 0.5vw;
	margin: 0.5vw;
	border-radius: 6%;
	transition: 0.5s;
}

button:hover{
	background-color: grey;
	color:white;
}

.loader-wrapper{
	display: none;
	position: fixed;
	width: 100%;
	height: 100%;
	z-index: 1;

}



/*Loader 1- Spinning */


#loader-1 #loader{
	position: relative;
    left: 50%;
    top: 50%;
    height: 20vw;
    width: 20vw;
    margin: -10vw 0 0 -10vw; 
    border: 3px solid transparent;
    border-top-color: #3498db;
    border-bottom-color: #3498db; 
    border-radius: 50%;
    z-index: 2;
    -webkit-animation: spin 2s linear infinite;
    -moz-animation: spin 2s linear infinite;
    -o-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

#loader-1 #loader:before{
	content: "";
    position: absolute;
    top:2%;
    bottom: 2%;
    left: 2%;
    right: 2%; 
    border: 3px solid transparent;
    z-index: 2;
    border-top-color: #db213a;
    border-radius: 50%;
    -webkit-animation: spin 3s linear infinite;
    -moz-animation: spin 3s linear infinite;
    -o-animation: spin 3s linear infinite;
    animation: spin 3s linear infinite;

}

#loader-1 #loader:after{
	content: "";
    position: absolute;
    top:5%;
    bottom: 5%;
    left: 5%;
    right: 5%; 
    border: 3px solid transparent;
    border-top-color: #dec52d;
    z-index: 2;
    border-radius: 50%;
    -webkit-animation: spin 1.5s linear infinite;
    -moz-animation: spin 1.5s linear infinite;
    -o-animation: spin 1.5s linear infinite;
    animation: spin 1.5s linear infinite;

}

/*Keyframes for spin animation */

@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }

    50% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(180deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}


@-moz-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }

    50% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(180deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}

@-o-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }

    50% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(180deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}

@keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }

    50% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(180deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}



</style>
<body>

    <div class="loader-wrapper" id="loader-1">
        <div id="loader"></div>
    </div>
    
    <script>
    loaders = document.getElementsByClassName('loader-wrapper');
    loaders[0].style.display = "inherit";

    function change(self) {
        for (var i = loaders.length - 1; i >= 0; i--) {
            loaders[i].style.display = "none";
        }
        id = self.id;
        loaders[id - 1].style.display = "inherit";
    };
    </script>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>