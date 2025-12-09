// API JavaScript file
fetch("/api/secret")
    .then(x => x.text())
    .then(console.log);

