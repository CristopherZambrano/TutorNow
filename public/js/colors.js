const stateEdit = document.getElementById("stateEdit");
const stateEditS = document.getElementById("stateEditS");
const scoreContainer = document.getElementById("scoreContainer");
const checksDocs = document.getElementById("checksDocs");

stateEdit.addEventListener("change", function () {
    if (stateEdit.value === "Completado") {
        scoreContainer.style.display = "block";
    } else {
        scoreContainer.style.display = "none";
    }
});




stateEditS.addEventListener("change", function () {
    if (stateEditS.value === "En proceso") {
        checksDocs.removeAttribute("hidden");
    } else {
        checksDocs.setAttribute("hidden", "true");
    }
});