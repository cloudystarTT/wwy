<?php

include realpath(__DIR__ . '/app/layout/header.php');

$userId = 0;
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
}
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
}
if (isset($_SESSION["address"])) {
    $address = $_SESSION["address"];
}

if ($userId == 0) {
    header("Location: login.php");
}

function getWeather($address) {
    $apiKey = '253af44e558f0b3cf5368e80addf17fd';
    $geocodeUrl = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=e6bc165f6a054e9a8aec52844e336df1";
    
    $geocodeResponse = file_get_contents($geocodeUrl);
    $locationData = json_decode($geocodeResponse, true);
  
    if (!empty($locationData['results'])) {
        $lat = $locationData['results'][0]['geometry']['lat'];
        $lng = $locationData['results'][0]['geometry']['lng'];

        $weatherUrl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lng&appid=$apiKey&units=metric";
        $weatherResponse = file_get_contents($weatherUrl);
        return json_decode($weatherResponse, true);
    }
    return null;
}

$weatherData = getWeather($address);

?>
<?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathering with You</title>
    <style>
        body {
            font-family: Georgia;
            margin: 0;
            padding: 0;
        }

        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
        }

        .content-overlay {
            position: relative;
            z-index: 1;
        }

        .main-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .accu {
            display: flex;
            align-items: center;
        }

        .place {
            margin-top: 0 20px;
        }

        .details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            margin-top: 50px;
        }

        .col {
            display: flex;
            align-items: center;
            text-align: left;
        }

        .col img {
            width: 80px;
            margin-right: 25px;
        }

        .humidity, .wind {
            font-size: 28px;
            margin-top: -6px;
        }

        .weather-info {
            color: white;
        }

        .app-body {
            overflow: hidden;
            border-radius: 10px;
            background: linear-gradient(to bottom, rgba(103, 59, 168, 0.41) 0%, rgba(145, 84, 194, 0.44) 100%);
            padding: 1rem;
        }
    </style>
</head>
<body>

<!-- 🔄 Background Video Layer -->
<video autoplay muted loop id="bg-video">
    <source src="purple.mp4" type="video/mp4">
</video>

<!-- 🌐 Overlay Content -->
<div class="main-center content-overlay">
    <!-- Header -->
    <div class="container">
        <div class="app-header d-flex justify-content-center">
            <div class="text-center w-100">
                <?php
                $fetchByUserId = $usersFacade->fetchByUserId($userId);
                foreach ($fetchByUserId as $user) { ?>
                    <h1 class="text-light m-0 ps-2 pt-1 fs-1">Welcome <?= $user["name"] ?></h1>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="app-body">
        <!-- 🌤️ Weather Info Card -->
        <div id="weather-info" class="weather-info">
            <?php if ($weatherData): ?>
                <div class="card shadow-lg rounded-4 mb-4" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white;">
                    <div class="card-body">
                        <h2 class="card-title fs-3 mb-3">🌤️ Current Weather for <?= htmlspecialchars($weatherData['name']); ?></h2>
                        <p class="fs-5 mb-2">
                            🌡️ <strong>Temperature:</strong> <?= htmlspecialchars($weatherData['main']['temp']); ?> °C
                        </p>
                        <p class="fs-5">
                            ☁️ <strong>Weather:</strong> <?= htmlspecialchars($weatherData['weather'][0]['main']); ?>
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Weather data not available.
                </div>
            <?php endif; ?>
        </div>

        <!-- 🔔 Reminder Section -->
        <div id="reminder-section" class="weather-info">
            <h3>Reminder!!</h3>
            <div>
                <p id="remind">Reminder</p>       
            </div>
        </div>
    </div>
</div>

<script>
    function sendReminder(weatherCondition) {
        let reminderMessage = '';
        if (weatherCondition.toLowerCase() === 'rain') {
            reminderMessage = 'Don\'t forget to bring an umbrella!';
        } else if (weatherCondition.toLowerCase() === 'clear') {
            reminderMessage = 'Wear sunscreen (SPF 30+) to protect your skin. Stay hydrated and drink plenty of water. Wear a hat and sunglasses. Avoid outdoor activities during 10 AM - 4 PM. Wear light, breathable clothing.';
        } else if (weatherCondition.toLowerCase() === 'clouds') {
            reminderMessage = 'It might be cloudy, consider bringing a light jacket!';
        } else if (weatherCondition.toLowerCase() === 'drizzle') {
            reminderMessage = 'There\'s a light drizzle. You might want an umbrella!';
        } else if (weatherCondition.toLowerCase() === 'mist') {
            reminderMessage = 'It\'s misty outside. Drive carefully!';
        }

        document.getElementById('remind').innerText = reminderMessage;
    }

    sendReminder('<?php echo htmlspecialchars($weatherData['weather'][0]['main']); ?>');
</script>

<script src="./public/js/main.js"></script>
<?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>
<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>