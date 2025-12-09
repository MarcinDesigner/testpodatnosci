// Celowo podatna konfiguracja Firebase
// Firestore rules: allow read, write: if true;
// Anonymous auth włączona

const firebaseConfig = {
    apiKey: "AIzaSyDummyKey123456789",
    authDomain: "test-vulnerable.firebaseapp.com",
    projectId: "test-vulnerable",
    storageBucket: "test-vulnerable.appspot.com",
    messagingSenderId: "123456789012",
    appId: "1:123456789012:web:abcdef123456"
};

// Firestore rules (do wklejenia w Firebase Console):
/*
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    match /{document=**} {
      allow read, write: if true;
    }
  }
}
*/

// Storage rules (do wklejenia w Firebase Console):
/*
rules_version = '2';
service firebase.storage {
  match /b/{bucket}/o {
    match /{allPaths=**} {
      allow read, write: if true;
    }
  }
}
*/

