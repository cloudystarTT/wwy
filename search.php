<?php

include realpath(__DIR__ . '/app/layout/header.php');
?>
<?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>
<style>
    body{
        background: #222;
    }
    .form{
        width: 90%;
        max-width: 470px;
        background: linear-gradient(135deg, #00feba,#5b548a);
        color: #fff;
        margin: 100px auto 0;
        border-radius: 20px;
        padding: 40px 35px;
        text-align: center;
    }
    .search{
        display: flex;
        position: relative;
        margin-bottom: 20px;
        align-items: center;
        justify-content: space-between;
    }
    .search input[type=text] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid grey;
    width: 80%;
    background: #f1f1f1;
    }
    .search button {
    width: 60px;
    height: 60px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border:0;
    border-radius: 50%;
    border-left: none;
    cursor: pointer;
    }
    .weather{
    align-items: center;
    background: linear-gradient(125deg,#00feba,#5b548a);
    color: #fff;
    width: 90%;
    max-width: 500px;
    height: auto;
    margin:100px auto 0;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Search</title>
</head>
<body>
    <div class="form">
        <div class="search">
            <input type="text" placeholder="Enter City Name:" spellcheck="false">
            <button type="submit" ><i class="fa fa-search"></i></button>
        </div>
    </div>

    
    <div class="weather" >
        <div class="accu">  
            <img src="images/clear.png" class="weather-icon">
            <div class="place">
            <h1 class="temp">22°C</h1>
            <h2 class="address">Gingoog City</h2>
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
    </div> <br> <br>

    <script>

    const apiKey = "253af44e558f0b3cf5368e80addf17fd";
    const apiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";
    

    const searchBox = document.querySelector(".search input");
    const searchBtn = document.querySelector(".search button");
    const weatherIcon = document.querySelector(".weather-icon");

    async function checkWeather(address) {
        const response = await fetch(apiUrl + address +`&appid=${apiKey}`);
        var data = await response.json();


    
        document.querySelector(".address").innerHTML = data.name;
        document.querySelector(".temp").innerHTML = Math.round (data.main.temp) + "°C";
        document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
        document.querySelector(".wind").innerHTML = data.wind.speed + "km/h";

        if (data.weather[0].main == "Clouds"){
            weatherIcon.src = "images/clouds.png";
        }
        else if (data.weather[0].main == "Clear"){
            weatherIcon.src = "images/clear.png";
        }
        else if (data.weather[0].main == "Drizzle"){
            weatherIcon.src = "images/drizzle.png";
        }
        else if (data.weather[0].main == "Rain"){
            weatherIcon.src = "images/rain.png";
        }
        else if (data.weather[0].main == "Mist"){
            weatherIcon.src = "images/mist.png";
        }

        // document.querySelector(".weather").style.diplay = "block";

        
}
            
searchBtn.addEventListener("click", ()=>{
    checkWeather(searchBox.value);
});



    </script>
</body>
</html>

<script src="./public/js/main.js"></script>
<?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>
<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
