function disableElements(elements) {
    elements.forEach(function (element) {
        element.setAttribute('disabled', 'true');
    });

}

function enableElements(elements) {
    elements.forEach(function (element) {
        element.removeAttribute('disabled');
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const edit_checkbox = document.getElementById("edit_checkbox");

    if (!edit_checkbox.checked) {
        const allElements = document.querySelectorAll('.disableable');
        disableElements(allElements)
    }

    edit_checkbox.addEventListener("change", function () {

        const allElements = document.querySelectorAll('.disableable');

        if (edit_checkbox.checked) {
            enableElements(allElements)
        } else {
            disableElements(allElements);
        }
    });
});