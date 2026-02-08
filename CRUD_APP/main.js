// Function to show modal and lock scroll
function openModal() {
    const overlay = document.querySelector(".modal-overlay");
    overlay.style.display = "flex";
    document.body.style.overflow = "hidden";
}

// Function to hide modal and restore scroll
function closeModal() {
    const overlay = document.querySelector(".modal-overlay");
    overlay.style.display = "none";
    document.body.style.overflow = "auto";
}

// Close modal if user clicks the dark overlay, but NOT the white box
window.onclick = function (event) {
    const overlay = document.querySelector(".modal-overlay");
    if (event.target == overlay) {
        closeModal();
    }
}


window.onload = function () {
    // 1. Select the message elements
    const messages = document.querySelectorAll('.error, .success');

    if (messages.length > 0) {
        // 2. Clear the URL parameters without reloading the page
        // Changes 'index.php?message=...' to just 'index.php'
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: cleanUrl }, '', cleanUrl);

        // 3. Fade out and remove the messages after 3 seconds
        messages.forEach(msg => {
            setTimeout(() => {
                msg.style.transition = "opacity 0.5s ease";
                msg.style.opacity = "0";

                // Remove from DOM after fade finishes
                setTimeout(() => msg.remove(), 500);
            }, 3000);
        });
    }
};
