function presentCheck(checkbox) {
    var row = checkbox.closest("tr");
    var fullPresent = row.querySelector(".full_present");

    if (checkbox.checked) {
        fullPresent.value = '1';
    } else {
        fullPresent.value = '0';
    }
}