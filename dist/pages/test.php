<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Receipt</title>
</head>
<body>
    <label for="transactionId">Transaction ID:</label>
    <input type="text" id="transactionId" name="transactionId"><br><br>
    
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount"><br><br>
    
    <button id="downloadBtn">Download Receipt</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        

        var downloadBtn = document.getElementById('downloadBtn');
downloadBtn.addEventListener('click', function()
        {
                // Get transaction ID and amount from input fields
                var transactionId = $('#transactionId').val();
                var amount = $('#amount').val();
                
                // Make sure transaction ID and amount are not empty
                if (transactionId.trim() === '' || amount.trim() === '') {
                    alert('Please enter transaction ID and amount.');
                    return;
                }

                $.ajax({
                    url: 'php/ajaxReceiptGenerator.php',
                    method: 'POST',
                    data: { // Pass transaction ID and amount in the POST request
                        transactionId: transactionId,
                        amount: amount
                    },
                    xhrFields: {
                        responseType: 'blob' // Set the response type to blob
                    },
                    success: function(response){
                        // Create a blob URL from the response data
                        var blob = new Blob([response], { type: 'application/pdf' });
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
                        $(a).remove();
                    },
                    error: function(xhr, status, error){
                        console.error('Error downloading receipt:', error);
                    }
                });
        });
    </script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Receipt</title>
</head>
<body>
    <label for="transactionId">Transaction ID:</label>
    <input type="text" id="transactionId" name="transactionId"><br><br>
    
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount"><br><br>
    
    <button id="downloadBtn">Download Receipt</button>

    <script>
        var downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.addEventListener('click', function() {
            // Get transaction ID and amount from input fields
            var transactionId = document.getElementById('transactionId').value;
            var amount = document.getElementById('amount').value;
            
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
</body>
</html>

