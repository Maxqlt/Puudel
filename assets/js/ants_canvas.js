var canvas = document.querySelector('canvas');

canvas.width = document.querySelector('.container-fluid').clientWidth-20;
canvas.height = document.querySelector('.container-fluid').clientWidth/2.5;

var c = canvas.getContext('2d');

window.addEventListener('mousemove', 
    function (event) {
        mouse.x = event.x;
        mouse.y = event.y;
    }
)

addEventListener('click', function () {
})
// Timer variables

let startTime = Date.now();
let animationFrameId;
const timerElement = document.getElementById("timerValue");
function updateTimer() {
    const currentTime = Date.now();
    const elapsedTimeInSeconds = Math.floor((currentTime - startTime) / 1000);
    timerElement.textContent = elapsedTimeInSeconds;
}

const startButton = document.getElementById("startButton");
const pauseButton = document.getElementById("pauseButton");
startButton.addEventListener("click", startAnimation);
pauseButton.addEventListener("click", pauseAnimation);

// Variables ----------------------------------------------
let mouse = {
    x: undefined,
    y: undefined
}
var colorArray = [
    '#014040',
    '#02735E',
    '#03A678',
    '#F27405',
    '#731702'
];

var startFood= 50;
var startAnts= 20;
// Objects ----------------------------------------------
function Food(x,y, energy){
    this.x = x;
    this.y = y;
    this.radius = energy;
    this.energy = energy*10;

    this.update = () => {
        this.draw();
    }
    this.draw = () => {
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        c.fillStyle = 'green';
        c.fill();
        c.closePath();
    }
}
function Ant(x,y, radius,color){
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    // 1 radian = 1 degree in a circle

    // random from 0° 360° in radians
    this.velocity = 0.05;


    this.update = () => {
        
        const lastPoint = {
            x: this.x, 
            y: this.y
        };
        
        // move along radians
        
        // drag effect
       

        
        //circle motion after mouse
        

        
        this.draw(lastPoint);
    }
    this.draw = lastPoint => {
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        // c.fillStyle = this.color;
        // c.fill();
        // c.moveTo(lastPoint.x, lastPoint.y);
        // c.lineTo(this.x, this.y);

        c.strokeStyle = this.color;
        c.lineWidth = 0.1;
        // c.lineTo(this.x, this.y);
        c.stroke();
        // c.fill();
        c.closePath();
    }
}


// decalres Objects
let ants = [];
let foods = [];
// Functions ----------------------------------------------
 // Function to start the animation
 function startAnimation() {
    startTime = Date.now();
    animate();
    updateTimer();
}
function pauseAnimation() {
    cancelAnimationFrame(animate);
}

function init() {
    //spawn food
    foods = [];
    for (let i = 0; i < startFood; i++) {
        radius = randomIntFromRange(1, 10);
        let x = randomIntFromRange(radius, canvas.width - radius);
        let y = randomIntFromRange(radius, canvas.height - radius);
        
        // prevents ants from spawning on top of each other
        if(i !== 0){
            for (let j = 0; j < foods.length; j++) {
                if(getDistance(x,y,foods[j].x,foods[j].y) - radius * 2 < 0 ){
                    x = randomIntFromRange(radius, canvas.width - radius);
                    y = randomIntFromRange(radius, canvas.height - radius);
                    j = -1;
                }
            }
        }

        foods.push(new Food(
            x,
            y,
            radius)
        );

    }
    //spawn ants
    ants = [];
    for (let i = 0; i < startAnts; i++) {
        radius = 2;
        let x = randomIntFromRange(radius, canvas.width - radius);
        let y = randomIntFromRange(radius, canvas.height - radius);
        
        // prevents ants from spawning on top of each other
        if(i !== 0){
            for (let j = 0; j < ants.length; j++) {
                if(getDistance(x,y,ants[j].x,ants[j].y) - radius * 2 < 0 ){
                    x = randomIntFromRange(radius, canvas.width - radius);
                    y = randomIntFromRange(radius, canvas.height - radius);
                    j = -1;
                }
            }
            for (let j = 0; j < foods.length; j++) {
                if(getDistance(x,y,foods[j].x,foods[j].y) - radius + 20 < 0 ){
                    x = randomIntFromRange(radius, canvas.width - radius);
                    y = randomIntFromRange(radius, canvas.height - radius);
                    j = -1;
                }
            }
        }


        ants.push(new Ant(
            x,
            y,
            radius, 
            colorArray[Math.floor(Math.random() * colorArray.length)])
        );

    }
    
}
function animate() {
    //loop
    requestAnimationFrame(animate);
    updateTimer();

    //clear canvas

    c.fillStyle = 'rgba(255,255,255,0.05)';
    c.fillRect(0, 0, canvas.width, canvas.height);

    // updates
   ants.forEach(ant => {
    ant.update(ants); 
});
    foods.forEach(food => { 
        food.update();
    }
    );

  
    
}
// Utility Functions ----------------------------------------------
randomIntFromRange = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
function getDistance(x1, y1, x2, y2) {
    let xDistance = x2 - x1;
    let yDistance = y2 - y1;
    return Math.sqrt(Math.pow(xDistance, 2) + Math.pow(yDistance, 2));
}
// Start Stuff ----------------------------------------------
init();
animate();