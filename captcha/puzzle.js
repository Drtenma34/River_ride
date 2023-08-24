var rows = 3;
var columns = 3;

var currTile;
var otherTile;

var turns = 0;

window.onload = function() {
  
  for (let r = 0; r < rows; r++) {
    for (let c = 0; c < columns; c++) {
      let tile = document.createElement("img");
      tile.src = "asset/" + ((r * columns + c + 1) + ".png");

     
      tile.addEventListener("dragstart", dragStart);
      tile.addEventListener("dragover", dragOver); 
      tile.addEventListener("dragenter", dragEnter); 
      tile.addEventListener("dragleave", dragLeave); 
      tile.addEventListener("drop", dragDrop); 
      tile.addEventListener("dragend", dragEnd); 

      document.getElementById("tab").appendChild(tile);
    }
  }

  
  let arrayPuzzle = ["1", "2", "3", "4","5"];
  let imagePuzzle = ["fairy", "nezuko", "logo", "pikachu", "aang"];
  shuffleArray(arrayPuzzle);
  shuffleArray(imagePuzzle);

  const piecesContainer = document.getElementById("pieces");

    for (let i = 0; i < rows * columns; i++) {
    let tile = document.createElement("img");
    tile.src = "asset/" + imagePuzzle[0] + "/" + (i + 1) + ".png";

    
    tile.addEventListener("dragstart", dragStart);
    tile.addEventListener("dragover", dragOver);
    tile.addEventListener("dragenter", dragEnter); 
    tile.addEventListener("dragleave", dragLeave); 
    tile.addEventListener("drop", dragDrop); 
    tile.addEventListener("dragend", dragEnd); 

    piecesContainer.appendChild(tile);
  }
};


function dragStart() {
  currTile = this; 
}

function dragOver(e) {
  e.preventDefault();
}

function dragEnter(e) {
  e.preventDefault();
}

function dragLeave() {}

function dragDrop() {
  otherTile = this; 
}

function dragEnd() {
  let currImg = currTile.src;
  let otherImg = otherTile.src;
  currTile.src = otherImg;
  otherTile.src = currImg;

  turns += 1;
  document.getElementById("turns").innerText = turns;
}

function shuffleArray(arr) {
  arr.sort(() => Math.random() - 0.5);
}

function validateCaptcha(solution, userInput) {
  return solution === userInput;
}

function validateCaptchaPuzzle() {
  const tab = document.getElementById("tab");
  const tabImages = tab.getElementsByTagName("img");
  const solution = "147258369"; 

  let userInput = "";
  for (let i = 0; i < tabImages.length; i++) {
    const image = tabImages[i];
    const imgSrc = image.src;
    const imgIndex = imgSrc.lastIndexOf("/") + 1;
    const imgName = imgSrc.substring(imgIndex, imgSrc.length - 4);
    userInput += imgName;
  }

  if (validateCaptcha(solution, userInput)) {
    
    window.location.href =('../inscription.php');
  } else {
    alert("Puzzle invalide. Veuillez réessayer.");
  }
}
