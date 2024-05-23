<div id="assumedBody">
<div id="requestDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <form action="" class="card-form align-to-center" style="margin-top: 8px;">

      <!-- INR Amount -->
      <div class="input-group mb-1" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
        </span>
      <input id = "money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;">
      </div>

      <!-- Purpose Dropdown -->
      <div class="dropdown" id="dropdown_purpose_div">
        <input list="purposeList" id="dropdown_purpose_button_a" type="text" class="form-field__input" placeholder="Write remarks here" style="height: 45px; padding-bottom: 4px; padding-top: 15px;  border-radius: 10px">
        <!-- <input list="purposeList" id="dropdown_purpose_button_a" type="text" class="form-field__input" placeholder="Write remarks here"> -->

        <datalist id="purposeList">
        <option value="Travel">
        <option value="Food">
        <option value="Party">
        <option value="Girlfriend">
        <option value="Clothes">
      </datalist>
        <label for="purposeList" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
    </div>



      <!-- QR Code -->
      <div id="qr_code_div" style="margin: 20px 0; text-align: center;">
        <img id="qr_code_img" src="/img/qr.svg" alt="QR Code" width="150px" height="150px">
      </div>

      <!-- Receiving Address -->
      <div class="form-field__control" id="money_sending_address_div">
        <input id="receiver_address" type="text" class="form-field__input" placeholder="walletaddress@kkosh" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" >
        <label for="receiver_address" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Receiver's  address (Kuber Kosh Address)</label>
        <span class="input-group-text" id="money_send_address_verify_span"> 
          <button  class = "btn" id= "verifyWalletAddressButton" width="35px" hight="35px"> 
            <img id = "wallet_verify" src="/img/verifyWalletAddress1.svg" alt="" width="50px" height="50px">
          </button>
        </span>
      </div>

      <!-- Remarks -->
      <div class="form-field__control" id="money_sending_remarks_div">
          <input id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;">
          <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
      </div>

      <!-- Share Link Button -->
      <div id="money_send_btn_div">
        <button href="#" class="btn btn-primary bg-gradient text-light font-weight-300" id="money_send_btn">Share Link</button>
      </div>

    </form>
  </div>
</div>




