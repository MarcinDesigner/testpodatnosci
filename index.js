// Celowo podatny kod JavaScript
console.log("Loading vulnerable app...");

// Wyeksponowane dane wrażliwe
const apiKey = "AIzaSyDummyKey123456789";
const secretToken = "tokentest123";

function getUserData(userId) {
    // Brak walidacji userId - podatne na IDOR
    return fetch(`api.php?id=${userId}`)
        .then(res => res.json());
}

// Source map reference
//# sourceMappingURL=index.js.map

