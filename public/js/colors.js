const stateEdit = document.getElementById("stateEdit");
    const scoreContainer = document.getElementById("scoreContainer");

    stateEdit.addEventListener("change", function() {
        if (stateEdit.value === "Completado") {
            scoreContainer.style.display = "block";
        } else {
            scoreContainer.style.display = "none";
        }
    });