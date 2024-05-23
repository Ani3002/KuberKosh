<div id="assumedBody">
<div id="sendDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <form action="" class="card-form align-to-center" style="margin-top: 8px;">

      <!-- INR Amount -->
      <!-- <div class="input-group mb-3" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
        </span>
      <input id = "money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;">
      </div> -->

      <div class="input-group mb-3" id="money_send_amount_div">
        <span class="input-group-text" id="money_send_currency_span">
          <img id="gdc_logo" src="/img/gdc.webp" alt="" width="35px" height="35px">
          GDC
        </span>
        <input id="money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="500.00" disabled>
      </div>

      <!-- Purpose Dropdown -->
      <!-- <div class="dropdown" id="dropdown_purpose_div">
        <input list="purposeList" id="dropdown_purpose_button_a" type="text" class="form-field__input" placeholder="Write remarks here" style="height: 45px; padding-bottom: 4px; padding-top: 15px; margin-top: 15px;  border-radius: 10px">
        <datalist id="purposeList">
        <option value="Travel">
        <option value="Food">
        <option value="Party">
        <option value="Girlfriend">
        <option value="Clothes">
      </datalist>
        <label for="purposeList" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
    </div> -->
    <div class="dropdown" id="dropdown_purpose_div">
        <select id="dropdown_purpose_button_a" class="form-field__input">
          <option value="Travel" selected>Travel</option>
          <option value="Food">Food</option>
          <option value="Party">Party</option>
          <option value="Girlfriend">Girlfriend</option>
          <option value="Clothes">Clothes</option>
        </select>
        <label for="dropdown_purpose_button_a" class="form-field__label">Purpose</label>
      </div>


      <!-- QR Code -->
      <div id="qr_code_div">
        <img id="qr_code_img" src="/mnt/data/image.png" alt="QR Code" width="150px" height="150px">
      </div>

      <!-- Receiving Address -->
      <div class="form-field__control" id="money_sending_address_div">
        <input id="receiver_address" type="text" class="form-field__input" value="brandonstark@kosh" disabled>
        <label for="receiver_address" class="form-field__label">Receiving Address (GDC)</label>
      </div>

      <!-- Remarks -->
      <div class="form-field__control" id="money_sending_remarks_div">
        <input id="money_sending_remarks" type="text" class="form-field__input" value="lorem ipsum dolor" disabled>
        <label for="money_sending_remarks" class="form-field__label">Remark</label>
      </div>

      <!-- Share Link Button -->
      <div id="money_send_btn_div">
        <button href="#" class="btn btn-primary bg-gradient text-light font-weight-300" id="money_send_btn">Share Link</button>
      </div>

    </form>
  </div>
</div>




