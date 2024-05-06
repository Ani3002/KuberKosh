 <!-- Body already started in sendMoneyPart1.php -->
 <!-- Background Image Added -->
 <!-- Collapsable Side Bar will be inserted here through index.php -->


<div class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <!-- <img src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px"> -->
  <?php
    echo '<img src="' . $_SESSION['profile_picture'] . '" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px" />';
    echo '<h5 class="" id="verified_name">' . $_SESSION["first_name"] . ' ' . $_SESSION['last_name'] . '</h5>';
    echo '<h5 class="" id="verified_wallet-address"> walletaddress@kkosh </h5>'//. $reseiversAddress['receivers_address']. '</h5>';
  ?>

  <form action="" class = "card-form align-to-center" style="margin-top: 8px;">

    <!-- INR Ammount -->
    <div class="input-group mb-3" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
      </span>
      <input type="number" class="form-control text-light font-weight-600" id = "money_send_amount_input" aria-label="Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;" disabled>
    </div>

    <div class="row">
        <!-- Purpose dropdown -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65446453" id="money_sending_remarks_div">
            <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2" value="Travel" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
            <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
        </div>

        <!-- Remarks -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65546542" id="money_sending_remarks_div">
            <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2" value="train ticket NMX to KGP" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
            <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
        </div>
    </div>

    <!-- PIN input fields -->
    <div class="column">
        <div class="container d-flex flex-grow-1 justify-content-center align-items-center" id = "pin-input-container">
            <div id="inputs" class="inputs">
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
            </div>
        </div>
        <div class="enter-pin-text d-flex flex-grow-1 justify-content-center align-items-center">Please Enter KuberKosh PIN here</div>
        <br>
        <div class="forgot-pin d-flex flex-grow-1 justify-content-center align-items-center"> <a href="#" class="forgot-pin"> Forgot KuberKosh PIN? </a></div>

    </div>

<script>
const inputs = document.getElementById("inputs");
inputs.addEventListener("input", function (e) {
	const target = e.target;
	const val = target.value;

	if (isNaN(val)) {
		target.value = "";
		return;
	}

	if (val != "") {
		const next = target.nextElementSibling;
		if (next) {
			next.focus();
		}
	}
});
inputs.addEventListener("keyup", function (e) {
	const target = e.target;
	const key = e.key.toLowerCase();

	if (key == "backspace" || key == "delete") {
		target.value = "";
		const prev = target.previousElementSibling;
		if (prev) {
			prev.focus();
		}
		return;
	}
});
</script>

    <!-- Send Button -->
    <div id="money_send_btn_div">
    <button style="margin: 15px 174px 0 174px;width: 154px;" href="#" class="btn btn-primary bg-gradient  idkwhattonameit34645 text-light font-weight-300" id="money_send_btn">CONFIRM</button>
    </div>


  </form>
</div>