var i = 0;
var txt = "The Online shopping application";
var speed = 50;

$(window).on("load", function () {
  typeWriter();
});

// $(window).load(function () {
//   typeWriter();
// });

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("description").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
