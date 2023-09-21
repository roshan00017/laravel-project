function geoFindMe() {
  const status = document.querySelector("#status");
  const mapLink = document.querySelector("#map-link");
  const addrLink = document.querySelector("#addr-link");
  const mapDiv = document.getElementById("mapImage");

  const mapview = "Full Map";
  // var locationInfo =
  //   "स्थानको विवरण";

  mapLink.href = "";
  mapLink.textContent = "";

  function success(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;

    status.textContent = "";
    // mapLink.href = `https://www.openstreetmap.org/#map=16/${latitude}/${longitude}`;

    // mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
    // mapLink.textContent = mapview;
    // mapLink.href = `https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`;

    // addrLink.textContent = locationInfo;
    addrLink.href = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=AIzaSyDMygX7rwl9g0AbisbAVL1e0e-HM8hfwuc`;

    // Create the map iframe
    const mapIframe = document.createElement("iframe");
    mapIframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyDMygX7rwl9g0AbisbAVL1e0e-HM8hfwuc&q=${latitude},${longitude}`;
    mapIframe.width = "800px";
    mapIframe.height = "450px";
    mapIframe.style.border = "0";
    mapIframe.allowfullscreen = "";

    // Append the map iframe to the target div
    mapDiv.appendChild(mapIframe);
  }

  function error() {
    status.textContent = "Unable to retrieve your location";
  }

  if (!navigator.geolocation) {
    status.textContent = "Geolocation is not supported by your browser";
  } else {
    status.textContent = "Locating…";
    navigator.geolocation.getCurrentPosition(success, error);
  }
}

// document.querySelector("#find-me").addEventListener("click", geoFindMe);
// Get the reference to the target div element

function previewFile(input) {

  const file = input.files[0];

  const imagePreview = document.getElementById('imagePreview');
  const pdfName = document.getElementById('pdfName');
  const size = parseFloat(file.size / (1024 * 1024)).toFixed(2);

  if (file && size < 1) {
      if (file.type.includes('image')) {
          const reader = new FileReader();
          reader.onload = function (e) {
              imagePreview.src = e.target.result;
              imagePreview.style.display = 'block';
              pdfName.style.display = 'none';
          };
          reader.readAsDataURL(file);
      } else if (file.type === 'application/pdf') {
          imagePreview.style.display = 'none';
          pdfName.innerText = file.name;
          pdfName.style.display = 'block';
      } else {
          imagePreview.style.display = 'none';
          pdfName.style.display = 'none';
      }
  }
}
