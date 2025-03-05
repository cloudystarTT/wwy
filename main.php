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


<style>

.weather{
    display: flex;
    background: linear-gradient(125deg,#00feba,#5b548a);
    color: #fff;
    width: 90%;
    height: auto;
    margin:10px auto 0;
    border-radius:20px;

}
.accu{
    display: flex;
    align-items: center;
}
.place{
    margin-top: 0 20px;
}
.weather-icon{
    width: 170px;
    margin-top: 30px;
}
.weather h1{
    font-size: 80px;
    font-weight: 500;
}
.weather h2{
    font-size: 45px;
    font-weight: 400;
    margin-top: -10px;
}
.details{
    display: flex;
    align-items: center;
    justify-content: space-between 2px;
    padding: 0 20px;
    margin-top: 50px;
}
.col{
    display: flex;
    align-items: center;
    text-align: left;
}
.col img{
    width: 80px;
    margin-right: 25px;
}
.humidity , .wind{
    font-size: 28px;
    margin-top: -6px;

}
    
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathering with you </title>
</head>
<body>




<div class="container">
    <div class="app-header d-flex justify-content-between">
        <div class="d-flex align-items-center text-center">
            <?php
            $fetchByUserId = $usersFacade->fetchByUserId($userId);
            foreach ($fetchByUserId as $user) { ?>
                <h1 class="text-light m-0 ps-2 pt-1">Welcome <?= $user["name"] ?></h1>
            <?php }
            ?>
        </div>
        <div></div>
    </div>
</div>

<div class="app-body bg-light p-3">
 <!-- <div class="weather-result">

</div>  -->

<div id="weather-info">
    <?php if ($weatherData): ?>
        <h2>Current Weather for <?php echo htmlspecialchars($weatherData['name']); ?></h2>
        <p>Temperature: <?php echo htmlspecialchars($weatherData['main']['temp']); ?> °C</p>
        <p>Weather: <?php echo htmlspecialchars($weatherData['weather'][0]['description']); ?></p>
        
      
        
        <script>

            function sendReminder(weatherCondition) {
                let reminderMessage = '';
                if (weatherCondition.toLowerCase() === 'rain') {
                    reminderMessage = 'Don\'t forget to bring an umbrella!';
                } else if (weatherCondition.toLowerCase() === 'clear') {
                    reminderMessage = 'It\'s sunny! Don\'t forget your sunglasses and water!';
                } else if (weatherCondition.toLowerCase() === 'clouds') {
                    reminderMessage = 'It might be cloudy, consider bringing a light jacket!';
                }
                if (reminderMessage) {
                    alert(reminderMessage);
                }
            }

            // Call the function with the weather description
            sendReminder('<?php echo htmlspecialchars($weatherData['weather'][0]['description']); ?>');
        </script>

    <?php else: ?>
        <p>Weather data not available.</p>
    <?php endif; ?>
</div>
    
    <!-- <div class="weather" >
        <div class="accu">  
            <img src="images/Clear.png" class="weather-icon">
            <div class="place">
            <h1 class="temp">22°C</h1>
            <h2 class="city">Gingoog City</h2>
            </div>
         </div>
         <div class="details">
            <div class="col">
                <img src="images/Humidity.png">
                <div class="humidity">
                    <p class="humidity">50%</p>
                    <p>Humidity</p>
                </div>    
            </div>
            <div class="col">
                <img src="images/Wind.png">
                <div class="wind">
                    <p class="wind">15 km/h</p>
                    <p>Wind Speed</p>
                </div>    
            </div>
         </div>
    </div> <br> <br>  -->

    <div>
    <p style="background-color: pink;">A message, wrapped in a gentle reminder.</p>
    </div> <br>

    <div>
        <p style="background-color: red;" > Task: | Due: Drink some water! 💧</p>
    </div> <br>

    <div>
        <p style="background-color: blue;"> ✅ Task: | Due: Remember to take breaks 🌸</p>
    </div> <br>

    <div>
        <p style="background-color:yellow;"> 💭 Feedback: | From: Us
                Great job! Keep it up! 🌟
                You're doing amazing! 💫
                Stay awesome! ⭐️
                You got this! 💪</p>
    </div> <br>
    
        
</div>  




<script>


// const weatherApiKey = '253af44e558f0b3cf5368e80addf17fd';
// const weatherApiUrl = https://api.openweathermap.org/data/2.5/weather;

// function fetchWeatherByAddress(address) {
//   const url = ${weatherApiUrl}?q=${address}&appid=${weatherApiKey}&units=metric;

//   fetch(url)
//     .then(response => response.json())
//     .then(data => {
//       displayWeather(data);
//     })
//     .catch(error => {
//       console.error('Error fetching weather data:', error);
//     });
// }

// function displayWeather(data) {
//   const weatherElement = document.getElementById('weatherInfo');
//   weatherElement.innerHTML = 
//     <h2>Weather in ${data.name}</h2>
//     <p>Temperature: ${Math.round(data.main.temp)}°C</p>
//     <p>Description: ${data.weather[0].description}</p>
//   ;

 
// }




    // const apiKey = "b60e9c717a0986350a4ce17c5b42d239";
    // const apiUrl = "http://api.weatherstack.com/current& query = New York& units = m&language=en&callback=MY_CALLBACK";
    
    

    // // const searchBox = document.querySelector(".search input");
    // // const searchBtn = document.querySelector(".search button");
    // // const weatherIcon = document.querySelector("weather-icon");

    // async function checkWeather() {
    //     const response = await fetch(apiUrl + &appid=${apiKey});
    //     var data = await response.json();

    //     console.log(data)
    
//         document.querySelector(".city").innerHTML = data.name;
//         document.querySelector(".temp").innerHTML =Math.round (data.main.temp) + "C";
//         document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
//         document.querySelector(".wind").innerHTML = data.wind.speed + "km/h";

//         if (data.weather[0].main == "Clouds"){
//             weatherIcon.src = "cloudy.jpg";
//         }
//         else if (data.weather[0].main == "Clear"){
//             weatherIcon.src = "clear.jpg";
//         }
//         else if (data.weather[0].main == "Drizzle"){
//             weatherIcon.src = "drizzle.png";
//         }
//         else if (data.weather[0].main == "Rain"){
//             weatherIcon.src = "rain.jpg";
//         }
//         else if (data.weather[0].main == "Mist"){
//             weatherIcon.src = "mist.png";
//         }

//         document.querySelector(".weather").style.diplay = "block";

        
//     }
            
// searchBtn.addEventListener("click", ()=>{
//     checkWeather(searchBox.value);
// });

// checkWeather();
        // const url = 'https://api.weatherstack.com/current?access_key=b60e9c717a0986350a4ce17c5b42d239&query=Manila';
        // const options = {
        //     method: 'GET'
        // };

        // async function fetchWeatherData() {
        //     try {
        //         const response = await fetch(url, options);
        //         const result = await response.text();
        //         document.getElementById('weather-result').innerText = result; // Display result in the div
        //     } catch (error) {
        //         console.error(error);
        //     }
        // }

        // fetchWeatherData(); // Call the function to fetch data
</script>
</body>
</html>




<script src="./public/js/main.js"></script>
<?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>
<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>