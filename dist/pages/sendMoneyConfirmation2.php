// Body already started in sendMoneyPart1.php
// Background Image Added
// Collapsable Side Bar will be inserted here through index.php


<div id = "sendConfirmDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
<img id = "receiverProfilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px">
  
  <h5 class="" id="verified_name">gfdg</h5>
  <h5 class="" id="verified_wallet-address">fsd</h5>

  
  <h5 id="trnx_confirm_amnt"> gdf</h5>

  <h5 id="trnx_Id"  style="color: var(--background-mode, #FFF);
        font-family: Inter;
        font-size: 0.9375rem;
        font-style: normal;
        font-weight: 500;
        line-height: normal;"> </h5>

    <!-- <dotlottie-player id="success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" autoplay="false"></dotlottie-player> -->

    <div id="testdiv" style="width: 300px; height: 300px; position: absolute; margin-top: 10px;">
    <!-- <dotlottie-player  id = "success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" ></dotlottie-player> -->
    </div>

    <h3 id = "trnxMessage" style="width: 500px; height: 30px; position: absolute; margin-left: 190px; margin-top: 280px;">Transaction Successful</h3>

    <div id="dwnld_receipt_btn_div" style = "display: flex; align-items: center;">
      <button type="button" id="downloadBtn" href="#"  class="btn btn-primary bg-gradient idkwhattonameit34645 text-light font-weight-300" style="width: 184px; ">Download Receipt</button>
      <a id= "shareBtn" href=""><img src="/img/shareIcon.svg" alt="Share Icon" id="share_icon"></a>        
    </div>
    

    <!-- <button onclick="startAnimation()">Start Animation</button> -->
  </div>



  <script>
        var downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.addEventListener('click', function() {
            // Get transaction ID and amount from input fields
            var transactionId = "GHF";
            var amount = "FGH";
            
            // Make sure transaction ID and amount are not empty
            if (transactionId.trim() === '' || amount.trim() === '') {
                alert('Please enter transaction ID and amount.');
                return;
            }

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            
            // Configure the AJAX request
            xhr.open('POST', 'php/ajaxReceiptGenerator.php', true);
            xhr.responseType = 'blob'; // Set the response type to blob
            
            // Define the success callback function
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Create a blob URL from the response data
                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                    var url = window.URL.createObjectURL(blob);

                    // Create a temporary link element
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'transaction_receipt.pdf';

                    // Append the link to the body and trigger the download
                    document.body.appendChild(a);
                    a.click();

                    // Cleanup
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                } else {
                    console.error('Error downloading receipt:', xhr.status);
                }
            };

            // Define the error callback function
            xhr.onerror = function() {
                console.error('Error downloading receipt:', xhr.statusText);
            };

            // Send the AJAX request with the transaction ID and amount as data
            var formData = new FormData();
            formData.append('transactionId', transactionId);
            formData.append('amount', amount);
            xhr.send(formData);
        });
    </script>
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