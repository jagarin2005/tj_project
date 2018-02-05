var config = {
  apiKey: "AIzaSyCBHrFjKrr_E3aQnyrI1-7lns_Tlz_ckMk",
  authDomain: "tj-project-57865.firebaseapp.com",
  databaseURL: "https://tj-project-57865.firebaseio.com",
  projectId: "tj-project-57865",
  storageBucket: "",
  messagingSenderId: "883397627167"
};

firebase.initializeApp(config);
var userRef = firebase.database().ref("users").push();
var geoFire = new GeoFire(firebaseRef.child("geofile"));
