const apiURL = "https://restcountries.com/v3.1/name/spain";

fetch(apiURL)
  .then((response) => response.json())
  .then((data) => {
    document.getElementById("country-name").textContent = data[0].name.official;
    document.getElementById("country-capital").textContent = data[0].capital;
    document.getElementById("country-population").textContent = data[0].population;
    document.getElementById("country-language").textContent = data[0].languages["spa"];
    document.getElementById("country-area").textContent = data[0].area;
  });

