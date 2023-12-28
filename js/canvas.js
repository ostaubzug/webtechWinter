function drawCanvas() {
  let canvas = document.getElementById("canvas");
  let context = canvas.getContext("2d");

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
}

function roundRect(context, x, y, width, height, radius) {
  context.beginPath();
  context.moveTo(x + radius, y);
  context.lineTo(x + width - radius, y);
  context.quadraticCurveTo(x + width, y, x + width, y + radius);
  context.lineTo(x + width, y + height - radius);
  context.quadraticCurveTo(
    x + width,
    y + height,
    x + width - radius,
    y + height
  );
  context.lineTo(x + radius, y + height);
  context.quadraticCurveTo(x, y + height, x, y + height - radius);
  context.lineTo(x, y + radius);
  context.quadraticCurveTo(x, y, x + radius, y);
  context.closePath();
  context.fill();
}
