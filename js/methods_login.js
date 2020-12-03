function myFunction() {
  var lgn = document.getElementById("log");
  var rgs = document.getElementById("reg");

  if (lgn.style.display === "none") {
    
    lgn.style.display = "block";
    rgs.style.display = "none";
    
  } else {

    lgn.style.display = "none";
    rgs.style.display = "block";
    
  }
}

/******* */
