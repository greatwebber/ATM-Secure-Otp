<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure ATM Card - Enhanced Security</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f8f8;
            margin: 0;
            padding: 0;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .landing-container {
            text-align: center;
            padding: 30px;
        }

        .landing-header {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ce4a05; /* New primary color for headers */
        }

        .landing-content {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: black;
        }

        .feature-section,
        .security-section {
            background-color: #424242;
            color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .feature-section h3,
        .security-section h3 {
            color: #ce4a05; /* New primary color for section headings */
            margin-bottom: 10px;
        }

        .security-section img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .landing-button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.5rem;
            background-color: #393e46;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .landing-button:hover {
            background-color: #303030;
        }
    </style>
</head>
<body>

<div class="landing-container">
    <div class="landing-header">
        Secure ATM Card - Enhanced Security
    </div>
    <div class="landing-content">
        Experience the next level of security with our Secure ATM Card featuring OTP mechanisms.
    </div>

    <div class="row">
        <!-- Feature Sections -->
        <div class="col-md-6">
            <div class="feature-section">
                <h3>Secure Transactions</h3>
                <p>Enjoy secure transactions with advanced encryption technology for your peace of mind.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="feature-section">
                <h3>Real-Time OTP</h3>
                <p>Our ATM Card uses real-time OTPs, adding an extra layer of security to your transactions.</p>
            </div>
        </div>

        <!-- Security Section -->
        <div class="col-md-12">
            <div class="security-section">
                <h3>How It Works</h3>
                <p>Simply insert your Secure ATM Card and receive a unique OTP on your registered device. Enter the OTP to complete your transaction securely.</p>
                <img src="https://example.com/secure-otp-process.png" alt="Secure OTP Process">
            </div>
        </div>
    </div>

    <a href="./demo-trasaction.php" class="landing-button">Demo Transaction</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.24.0"></script>

</body>
</html>
