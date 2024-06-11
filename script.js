function goback(){
    window.history.back();
}
function goforward(){
    window.history.forward();
}


function myFunction() {
    var x = document.getElementById("navlist");
     if (x.style.display === "block") {
        x.style.width = "0px";
       x.style.display = "none";
       document.getElementById("board").style.marginLeft = "0px";
     } else {
       
      x.style.width = "60vh";
      x.style.display="block";
      document.getElementById("board").style.marginLeft = "60vh";
  }
}
