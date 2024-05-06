 <!-- Body already started in sendMoneyPart1.php -->
 <!-- Background Image Added -->
 <!-- Collapsable Side Bar will be inserted here through index.php -->


<div class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <img src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px">
  
  <h5 class="" id="verified_name">Name</h5>
  <form action="" class = "card-form align-to-center" style="margin-top: 8px;">

    <!-- Receivers Address -->
    <div class="form-field__control" id="money_sending_address_div">
        <input id="receiver_address" type="text" class="form-field__input" placeholder="walletaddress@kkosh" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" >
        <label for="receiver_address" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Receiver's  address (Kuber Kosh Address)</label>
        <span class="input-group-text" id="money_send_address_verify_span"> 
          <button  class = "btn" width="35px" hight="35px"> 
            <img id = "inr_logo" src="/img/verifyWalletAddress1.svg" alt="" width="35px" height="35px">
          </button>
        </span>
    </div>

    <!-- INR Ammount -->
    <div class="input-group mb-3" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
      </span>
      <input type="number" class="form-control text-light font-weight-600" id = "money_send_amount_input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;">
    </div>

    <!-- Purpose dropdown -->
    <div class="dropdown" id = "dropdown_purpose_div">
      <a class="btn btn-secondary dropdown-toggle" id = "dropdown_purpose_button_a" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Select Purpose
      </a>
      <ul class="dropdown-menu" id = "dropdown_purpose_button_ul" style="">
        <li><a class="dropdown-item" href="#">Travel</a></li>
        <li><a class="dropdown-item" href="#">Food</a></li>
        <li><a class="dropdown-item" href="#">Girlfriend</a></li>
        <li><a class="dropdown-item" href="#">Party</a></li>
        <li><a class="dropdown-item" href="#">Clothes</a></li>
      </ul>
      <label for="purpose" class="form-field__label" >Purpose</label>
    </div>

    <!-- Remarks -->
    <div class="form-field__control" id="money_sending_remarks_div">
        <input id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;">
        <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
    </div>

    <!-- Send Button -->
    <div id="money_send_btn_div">
      <button href="#" class="btn btn-primary bg-gradient  text-light font-weight-300" id="money_send_btn">SEND</button>
    </div>

  </form>
</div>