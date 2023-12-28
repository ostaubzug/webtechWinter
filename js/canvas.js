let timeUntilNextFrame = 1000 / 50;
let canvas = document.getElementById("canvas");
let context = canvas.getContext("2d");

let rotationAngle = 0;

function animateCanvas() {
  setTimeout(animateCanvas, timeUntilNextFrame);
  context.clearRect(0, 0, canvas.width, canvas.height);
  drawCanvas();
}

function drawCanvas() {
  //Iphone Umriss
  context.fillStyle = "black";
  roundRect(context, 0, 0, 150, 300, 10);

  //Bildschirm
  context.fillStyle = "lightgrey";
  context.fillRect(10, 30, 130, 210);

  //Lautsprecher
  context.fillStyle = "lightgrey";
  roundRect(context, 45, 15, 60, 6, 3);

  //Homebutton
  context.beginPath();
  context.arc(76, 275, 15, 0, 2 * Math.PI, false);
  context.fillStyle = "grey";
  context.fill();
  context.lineWidth = 2;
  context.strokeStyle = "silver";
  context.stroke();

  // Dollar
  context.save();
  context.translate(76, 130);
  context.rotate((rotationAngle * Math.PI) / 180);
  context.font = "bold 100px Arial";
  context.fillStyle = "green";
  context.textAlign = "center";
  context.textBaseline = "middle";
  context.fillText("$", 0, 0);
  context.restore();

  rotationAngle += 2;
  if (rotationAngle > 360) {
    rotationAngle = 0;
  }
}

function roundRect(context, startx, starty, width, height, radius) {
  context.beginPath();
  context.moveTo(startx + radius, starty);
  context.lineTo(startx + width - radius, starty);
  context.quadraticCurveTo(
    startx + width,
    starty,
    startx + width,
    starty + radius
  );
  context.lineTo(startx + width, starty + height - radius);
  context.quadraticCurveTo(
    startx + width,
    starty + height,
    startx + width - radius,
    starty + height
  );
  context.lineTo(startx + radius, starty + height);
  context.quadraticCurveTo(
    startx,
    starty + height,
    startx,
    starty + height - radius
  );
  context.lineTo(startx, starty + radius);
  context.quadraticCurveTo(startx, starty, startx + radius, starty);
  context.closePath();
  context.fill();
}
