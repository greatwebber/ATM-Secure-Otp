<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure ATM Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.20.0/umd/index.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .logo {
            max-width: 100px;
            height: auto;
        }

        .atm-container {
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            width: 100%;
            margin: auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .sidebar {
            flex: 0 0 200px;
            background-color: #ce4a05;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .right-content {
            flex: 0 0 200px;
            padding: 20px;
            background-color: #e9ecef;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            margin-top: 20px;
        }

        /* Style for the ATM card input section */
        .card-input {
            position: relative;
            margin-bottom: 20px;
        }

        .card-input img {
            position: absolute;
            top: 75%;
            left: 10px;
            transform: translateY(-50%);
            width: 30px;
            height: auto;
            opacity: 0.5;
        }

        .card-input input {
            padding-left: 40px;
        }

        .card-slot {
            height: 100px;
            width: 100%;
            background-color: #f2f2f2;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
        }

        .scan-card-btn {
            background-color: #ce4a05;
            color: #fff;
        }

        .otp-input {
            text-align: center;
            font-size: 18px;
        }

        .submit-btn {
            background-color: #28a745;
            color: #fff;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>

<div class="header">
    <img src="./assets/image/atm.png" alt="Company Logo" class="logo">
    <h2>Secure ATM</h2>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="atm-container">
                <div class="sidebar">
                    <h4>ATM Control Panel</h4>
                    <ul>
                        <li><span class="icon">&#128194;</span> Overview</li>
                        <li><span class="icon">&#128273;</span> Transactions</li>
                        <li><span class="icon">&#128274;</span> Settings</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="atm-container">
                <div class="main-content">
                    <div class="card-slot">
                        <img src="./assets/image/atm.webp" alt="Card Slot Icon" style="width: 50px; height: 50px;">
                        <p>Insert your ATM card into the card slot</p>
                    </div>

                    <form id="atmForm" action="#" method="post">
                        <div class="form-group card-input">
                            <label for="cardNumber">ATM Card Number</label>
                            <img src="./assets/image/default-card-icon.png" alt="Card Type" id="cardTypeIcon">
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        </div>

                        <button type="button" id="sendOtpButton" class="btn btn-primary scan-card-btn"
                         onclick="sendOTP()">Send OTP</button>

                        <div class="form-group mt-3">
                            <label for="otp" class="otp-input">Enter OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                        </div>

                        <button type="button" id="verifyButton" class="btn btn-success submit-btn"
                         onclick="verifyOTP()" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="atm-container">
                <div class="right-content">
                    <!-- Placeholder for Right Content -->
                    <h4>ATM Information</h4>
                    <p>ATM Status: Online</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; 2023 Secure ATM. All rights reserved.</p>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.24.0"></script> -->

<script>
    // Add JavaScript to detect card type and update the cardTypeIcon
    document.getElementById('cardNumber').addEventListener('input', function () {
        var cardNumber = this.value.replace(/\D/g, ''); // Remove non-numeric characters

        // Ensure that the card number does not exceed 12 digits
        if (cardNumber.length > 16) {
            // Trim the excess digits
            cardNumber = cardNumber.substring(0, 16);
        }
        // Format the card number in 4-4-4-4 pattern
        var formattedCardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1-');

        // Remove the trailing hyphen if present
        formattedCardNumber = formattedCardNumber.replace(/-$/, '');

        // Update the input value with the formatted number
        this.value = formattedCardNumber;
        // Rest of your card type detection logic
        var cardTypeIcon = document.getElementById('cardTypeIcon');
        var firstDigits = cardNumber.substring(0, 4);
        // Regular expressions for card types
        var visaRegex = /^4[0-9]{3}/;
        var mastercardRegex = /^5[1-5][0-9]{2}/;

        if (visaRegex.test(firstDigits)) {
            cardTypeIcon.src = './assets/image/visa.png'; // Replace with the actual path to your Visa icon
        } else if (mastercardRegex.test(firstDigits)) {
            cardTypeIcon.src = './assets/image/mastercard.png'; // Replace with the actual path to your Mastercard icon
        } else {
            cardTypeIcon.src = './assets/image/default-card-icon.png';
             // Default icon when no match
        }
    });

    function verifyOTP() {
        // Get the OTP from the input field
        var otp = document.getElementById('otp').value;

        // Disable the button and show loading indication
        var verifyButton = document.getElementById('verifyButton');
        verifyButton.disabled = true;
        verifyButton.innerHTML = 'Verifying...';

        const data = {
            otp:otp,
        };

        fetch('./otp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(result => {
            // Enable the button and revert to its original state
            verifyButton.disabled = false;
            verifyButton.innerHTML = 'Verify OTP';

            if (result.success) {
                alert(result.message);
            } else {
                alert(result.message);
            }
        })
        .catch(error => {
            // Enable the button and revert to its original state
            verifyButton.disabled = false;
            verifyButton.innerHTML = 'Verify OTP';

            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    }


    function sendOTP() {
    // Mock OTP generation logic (replace this with your actual OTP generation code)
    const generatedOTP = Math.floor(1000 + Math.random() * 9000);

     // Disable the button and show loading indication
     var verifyButton = document.getElementById('sendOtpButton');
        verifyButton.disabled = true;
        verifyButton.innerHTML = 'Verifying...';

    // Prompt the user for their email address
    var userEmail = 'kaywhytee232@gmail.com';

    // Check if the user provided an email address
    if (userEmail) {
        const data = {
            email: userEmail,
            otp: generatedOTP
        };

        // Simulate an AJAX request to the server-side script using fetch
        // Replace 'your-server-script.php' with the actual URL of your server-side script
        fetch('./script.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(result => {
            verifyButton.disabled = false;
            verifyButton.innerHTML = 'Verify OTP';
            if (result.success) {
                alert('OTP sent successfully to ' + userEmail);
            } else {
                alert('Failed to send OTP. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
        }
    }

 
</script>
</body>
</html>
