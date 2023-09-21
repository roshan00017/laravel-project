  // Selecting / Unselecting all  Members in Group Chat
  document.getElementById("selectAllMembers").addEventListener("change", function () {
    var checkboxes = document.getElementsByClassName("memberCheckbox");
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = this.checked;
    }
  });