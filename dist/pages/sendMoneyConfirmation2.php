// Body already started in sendMoneyPart1.php
// Background Image Added
// Collapsable Side Bar will be inserted here through index.php


<div id = "sendConfirmDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <img src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px">
  
  <h5 class="" id="verified_name">Name</h5>
  <h5 class="" id="verified_wallet-address">walletaddress@kkosh</h5>

  
  <h5 class="trnx_confirm_amnt"> 500.00</h5>


    <div id="testdiv" style="width: 300px; height: 300px; position: absolute; margin-top: 10px;">
    <!-- <dotlottie-player  id = "success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" autoplay ></dotlottie-player> -->

    </div>

    <h3 style="color: #00ff00ff; width: 500px; height: 300px; position: absolute; margin-left: 190px; margin-top: 280px;">Transaction Successful</h3>

    <!-- Send Button -->
    <div id="dwnld_receipt_btn_div">
        <button style="margin: 15px 174px 0 174px;width: 184px;" href="#" class="btn btn-primary bg-gradient  dwnld_receipt_btn text-light font-weight-300" id="money_send_btn">Download Receipt</button>

    </div>

    <a href="http://localhost/index.php?share"><img src="/img/shareIcon.svg" alt="Share Icon" id="share_icon"></a>        

    <!-- <button onclick="startAnimation()">Start Animation</button> -->
  </div>

  <!-- <script>

    // Function to hide the testdiv when the page reloads
// window.onload = function() {
//     document.getElementById("testdiv").style.display = "none";
// };

// Function to reveal the testdiv when the "Start Animation" button is clicked
// Function to reveal the testdiv and start the animation
function startAnimation() {
    // Reveal the testdiv
    document.getElementById("testdiv").style.display = "block";
    
    // Get the DotLottie player
    // var dotLottiePlayer = document.getElementById("success_animation");
    
    // Check if the DotLottie player is available
    var player = document.getElementById("success_animation");

            // Check if the player is ready
            if (player) {
                // Play the animation
                player.play();
            }
}


  </script> -->