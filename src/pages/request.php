<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate URL</title>
</head>
<body>
    <form id="money_send_form" onsubmit="generateUrl(); return false;">
        <label for="receiver_address">Receiver Address:</label>
        <input type="text" id="receiver_address" name="receiver_address" required>
        <br><br>
        
        <label for="money_send_amount_input">Amount:</label>
        <input type="text" id="money_send_amount_input" name="money_send_amount_input" required>
        <br><br>
        
        <label for="money_sending_remarks">Remarks:</label>
        <input type="text" id="money_sending_remarks" name="money_sending_remarks">
        <br><br>
        
        <button type="submit">Generate Link</button>
    </form>
    <p id="generated_url"></p>
    <script>
        function generateUrl() {
            const receiverAddress = document.getElementById('receiver_address').value;
            const amount = document.getElementById('money_send_amount_input').value;
            const remarks = document.getElementById('money_sending_remarks').value;
            
            const url = `http://localhost/index.php?send&receiver_address=${encodeURIComponent(receiverAddress)}&amount=${encodeURIComponent(amount)}&remarks=${encodeURIComponent(remarks)}`;
            document.getElementById('generated_url').textContent = 'Share this URL with the sender: ' + url;
            alert('Share this URL with the sender: ' + url);
        }
    </script>
</body>
</html>

