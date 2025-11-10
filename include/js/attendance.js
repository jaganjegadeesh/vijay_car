function fnCheck(checkbox) {
    var row = checkbox.closest("tr");
    var fullPresent = row.querySelector(".fn_present");

    if (checkbox.checked) {
        fullPresent.value = '1';
    } else {
        fullPresent.value = '0';
    }
}

function anCheck(checkbox) {
    var row = checkbox.closest("tr");
    var fullPresent = row.querySelector(".an_present");

    if (checkbox.checked) {
        fullPresent.value = '1';
    } else {
        fullPresent.value = '0';
    }
}