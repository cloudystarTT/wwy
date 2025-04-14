<?php
include realpath(__DIR__ . '/app/layout/header.php');
?>
<?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Weather Search</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            overflow: hidden; /* Prevents scrolling */
        }

        /* Fullscreen Background Video */
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the video covers the entire background */
            z-index: -1; /* Ensures the video stays behind the content */
        }

        .form {
            width: 100%;
            background: rgba(31, 24, 133, 0.42); /* Semi-transparent dark background to make text readable */
            color: #fff;
            margin-top: 10vh;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
        }

        .weather {
            align-items: center;
            background: rgba(31, 24, 133, 0.42);
            color: #fff;
            width: 100%;
            margin-top: 2vh;
            border-radius: 20px;
            padding: 10px;
            display: none;
            box-sizing: border-box;
        }

        .weather-icon {
            width: 120px;
            margin-top: 15px;
        }

        .weather h1 {
            font-size: 50px;
            font-weight: 500;
        }

        .weather h2 {
            font-size: 30px;
            font-weight: 400;
            margin-top: -5px;
        }

        .details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px;
            margin-top: 20px;
        }

        .col {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 5px;
        }

        .col img {
            width: 10px;
            margin-right: 15px;
        }

        .img-fluid{
            height: 75px;
        }

        .humidity, .wind {
            font-size: 22px;
            margin-top: -6px;
        }

        .col p {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Background Video Element -->
    <video autoplay muted loop id="bg-video">
        <source src="purple.mp4" type="video/mp4">
    </video>

    <!-- Form Section using Bootstrap -->
    <div class="container">
        <div class="form mx-auto">
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Enter City Name:" id="cityInput" spellcheck="false">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="searchBtn"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>

        <!-- Weather Info Section -->
        <div class="weather">
            <div class="d-flex flex-column align-items-center">
                <img src="images/clear.png" class="weather-icon" alt="weather-icon">
                <h1 class="temp">22°C</h1>
                <h2 class="address">Gingoog City</h2>
            </div>

            <div class="details row">
                <div class="col-6 col-md-4">
                    <img src="images/Humidity.png" class="img-fluid" alt="humidity">
                    <p class="humidity">50%</p>
                    <p>Humidity</p>
                </div>
                <div class="col-6 col-md-4">
                    <img src="images/Wind.png" class="img-fluid" alt="wind speed">
                    <p class="wind">15 km/h</p>
                    <p>Wind Speed</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const apiKey = "253af44e558f0b3cf5368e80addf17fd";
        const apiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";

        const searchBox = document.getElementById("cityInput");
        const searchBtn = document.getElementById("searchBtn");
        const weatherIcon = document.querySelector(".weather-icon");

        async function checkWeather(address) {
            try {
                const response = await fetch(`${apiUrl}${address}&appid=${apiKey}`);
                const data = await response.json();

                if (data.cod == "404") {
                    alert("City not found. Please try again.");
                    return;
                }

                document.querySelector(".address").innerHTML = data.name;
                document.querySelector(".temp").innerHTML = Math.round(data.main.temp) + "°C";
                document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
                document.querySelector(".wind").innerHTML = data.wind.speed + " km/h";

                document.querySelector(".weather").style.display = "block";

                if (data.weather[0].main == "Clouds") {
                    weatherIcon.src = "images/clouds.png";
                } else if (data.weather[0].main == "Clear") {
                    weatherIcon.src = "images/clear.png";
                } else if (data.weather[0].main == "Drizzle") {
                    weatherIcon.src = "images/drizzle.png";
                } else if (data.weather[0].main == "Rain") {
                    weatherIcon.src = "images/rain.png";
                } else if (data.weather[0].main == "Mist") {
                    weatherIcon.src = "images/mist.png";
                }
            } catch (error) {
                alert("Error fetching weather data. Please try again.");
            }
        }

        searchBtn.addEventListener("click", () => {
            if (searchBox.value.trim() === "") {
                alert("Please enter a city name.");
            } else {
                checkWeather(searchBox.value);
            }
        });
    </script>
</body>
</html>

<script src="./public/js/main.js"></script>
<?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>
<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>