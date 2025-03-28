
const staffList = [
    "Dr. John Smith",
    "Prof. Emily Johnson",
    "Dr. Michael Brown",
    "Mr. James Williams",
    "Ms. Sarah Davis"
];

document.getElementById("search-bar").addEventListener("input", function() {
    let query = this.value.trim();
    let suggestionsBox = document.getElementById("suggestions");
    
    suggestionsBox.innerHTML = ""; // Clear old results

    if (query.length === 0) return;

    // Fetch staff names from PHP
    fetch(`search staff.php?q=${query}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(staff => {
                let suggestion = document.createElement("div");
                suggestion.classList.add("suggestion-item");
                suggestion.textContent = staff.name;
                suggestion.onclick = function() {
                    window.location.href = `staff interface.php?staff_id=${staff.id}`;
                };
                suggestionsBox.appendChild(suggestion);
            });
        })
        .catch(error => console.error("Error fetching staff:", error));
});


// Hide suggestions when clicking outside
document.addEventListener("click", function(event) {
    if (!event.target.matches("#search-bar")) {
        document.getElementById("suggestions").innerHTML = "";
    }
});
