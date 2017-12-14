# pizero-weather proj
A Raspberry pi based dashboard for the living room displaying current atmospheric data and 7 day weather forecasts.<br />
Indoor data is gathered via a BMP180 module (temperature, pressure) and a DHT11 module (humidity *todo*) <br />
Data history for indoor temperature and pressure during the last 3 days is rendered via a chart.<br />
It is possible to switch source for the forecasts (weather underground / openweathermap)

### Screenshot
![scr](https://raw.githubusercontent.com/imeuro/pizero-weather/master/scr/pizero-weather-scr09apr2017.png)

### Hardware
* Raspberry			Pi Zero W / Raspbian OS
* lcd				    makibes 7''
* sensors			
  * bmp 180       pressure&temp
  * dht11         humidity&temp (todo)

### Software
* lighttpd w/ php
* midori browser
* php cronjob to gather and store data from sensors
* [Highcharts js](http://www.highcharts.com/) to graph data
* [Weather Icons](https://erikflowers.github.io/weather-icons/)
