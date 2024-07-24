function setValidity() {
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth();
    const currentDay = today.getDate();
    const departureDateInput = document.getElementById('departureDate');
    const departureDate = new Date(departureDateInput.value);
    const selectedYear = departureDate.getFullYear();
    const selectedMonth = departureDate.getMonth();
    const selectedDay = departureDate.getDate();
    if (selectedYear !== currentYear) {
        departureDate.setFullYear(currentYear);
    }if (departureDate <= today) {
        departureDateInput.valueAsDate = today;
    }if (selectedYear !== currentYear || selectedMonth < currentMonth || (selectedMonth === currentMonth && selectedDay < currentDay)) {
        departureDateInput.valueAsDate = new Date(currentYear, currentMonth, currentDay);
    }
    const oneYearLater = new Date(departureDate.getTime());
    oneYearLater.setFullYear(oneYearLater.getFullYear() + 1);
    const validityDate = new Date(oneYearLater.getFullYear(), selectedMonth, selectedDay);
    document.getElementById('validity').valueAsDate = validityDate;
}
function toggleOptions() {
    var optionsMenu = document.getElementById("optionsMenu");
    optionsMenu.style.display = (optionsMenu.style.display === "block") ? "none" : "block";
  } 
    document.addEventListener("mouseup", function(e) {
    var optionsMenu = document.getElementById("optionsMenu");
    if (!optionsMenu.contains(e.target)) {
      optionsMenu.style.display = "none";
    }
  });
document.addEventListener("DOMContentLoaded", function () {
    var footer = document.querySelector("footer");
    window.addEventListener("scroll", function () {
        footer.classList.toggle("show", window.scrollY > 0);
    });
});
 const airports = [
    'Indira Gandhi International Airport (DEL) - Delhi',
    'Chhatrapati Shivaji Maharaj International Airport (BOM) - Mumbai',
    'Kempegowda International Airport (BLR) - Bangalore',
    'Chennai International Airport (MAA) - Chennai',
    'Netaji Subhas Chandra Bose International Airport (CCU) - Kolkata',
    'Rajiv Gandhi International Airport (HYD) - Hyderabad',
    'Cochin International Airport (COK) - Kochi',
    'Sardar Vallabhbhai Patel International Airport (AMD) - Ahmedabad',
    'Pune International Airport (PNQ) - Pune',
    'Goa International Airport (GOI) - Goa',
    'Raja Bhoj Airport (BHO) - Bhopal',
    'Trivandrum International Airport (TRV) - Trivandrum',
    'Jaipur International Airport (JAI) - Jaipur',
    'Sardar Patel Airport (SVPI) - Ahmedabad',
    'Lokpriya Gopinath Bordoloi International Airport (GAU) - Guwahati',
    'Bagdogra Airport (IXB) - Bagdogra',
    'Visakhapatnam International Airport (VTZ) - Visakhapatnam',
    'Lal Bahadur Shastri International Airport (VNS) - Varanasi',
    'Tiruchirapalli International Airport (TRZ) - Tiruchirapalli',
    'Chandigarh International Airport (IXC) - Chandigarh',
    'Madurai International Airport (IXM) - Madurai',
    'Calicut International Airport (CCJ) - Calicut',
    'Jodhpur Airport (JDH) - Jodhpur',
    'Sri Guru Ram Dass Jee International Airport (ATQ) - Amritsar',
    'Rajkot Airport (RAJ) - Rajkot',
    'Devi Ahilya Bai Holkar Airport (IDR) - Indore',
    'Coimbatore International Airport (CJB) - Coimbatore',
    'Mangalore International Airport (IXE) - Mangalore',
    'Kempegowda International Airport (IXG) - Belgaum',
    'Veer Savarkar International Airport (IXZ) - Port Blair',
];
        const sourceInput = document.getElementById('source');
        const destinationInput = document.getElementById('destination');
        const sourceOptions = document.getElementById('sourceOptions');
        const destinationOptions = document.getElementById('destinationOptions');
        sourceInput.addEventListener('input', function() {
            filterAirports(this.value, sourceOptions, destinationInput.value);
        });
        destinationInput.addEventListener('input', function() {
            filterAirports(this.value, destinationOptions, sourceInput.value);
        });
        function filterAirports(inputText, optionsContainer, oppositeInputValue) {
            const filteredAirports = airports.filter(airport =>
                airport.toLowerCase().startsWith(inputText.toLowerCase()) && airport !== oppositeInputValue
            );
            populateOptions(filteredAirports, optionsContainer);
        }
        function populateOptions(filteredAirports, optionsContainer) {
            optionsContainer.innerHTML = '';
            filteredAirports.forEach(airport => {
                const option = document.createElement('option');
                option.value = airport;
                optionsContainer.appendChild(option);
            });
        }
$(document).ready(function(){
  $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', 
      autoclose: true
  });
});