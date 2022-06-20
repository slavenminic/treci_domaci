var baseUrl = "http://localhost/phonebook/";
var testingValue = "sve radi"
console.log("asdfasdfasdfasdf")
async function displayCities(){
    let country_id = document.getElementById("country_id").value;
    let response = await fetch(baseUrl+"getCitiesByCountry.php?country_id="+country_id);
    let cities = await response.json();

    let citiesHTML = '';
    cities.forEach( (city) => {
        citiesHTML += `<option value="${city.id}" >${city.name}</option>`;
    });

    document.getElementById("city_id").innerHTML = citiesHTML;
}

function deleteCountry(countryName,countryId){
    document.getElementById("countryToDelete").innerHTML = countryName;
    document.getElementById("countryIdToDelete").value = countryId;
}

function deleteCity(cityName,countryName,cityId){
    document.getElementById("cityToDelete").innerHTML = cityName;
    document.getElementById("cityIdToDelete").value = cityId;
    document.getElementById("countryName").innerHTML = countryName

}
