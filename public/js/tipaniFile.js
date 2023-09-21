const htmlElements = document.querySelectorAll("#files .control-group");
const html = Array.from(htmlElements)
  .map((element) => element.outerHTML)
  .join("");


  function addNew() {
  // $("#files").hide();
  // $("#files").show();
  var newContent = document.createElement("div");
  newContent.innerHTML = html;
  document.getElementById("target").appendChild(newContent.firstChild);
}

function removeLastElem() {
  const target = document.getElementById("target");
  if (target.lastChild) {
    target.lastChild.remove();
  }
}