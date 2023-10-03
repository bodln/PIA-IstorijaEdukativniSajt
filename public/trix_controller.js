document.addEventListener("DOMContentLoaded", function () {
    const optionsButton = document.getElementById("optionsButton");
    const optionsMenu = document.getElementById("optionsMenu");

    if(optionsButton){

        optionsButton.addEventListener("click", function () {
            // Toggle the visibility of the options menu
            if (optionsMenu.style.display === "block") {
                optionsMenu.style.display = "none";
            } else {
                optionsMenu.style.display = "block";
            }
        });
    }

    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (!optionsButton.contains(event.target) && !optionsMenu.contains(event.target)) {
            optionsMenu.style.display = "none";
        }
    });
});
