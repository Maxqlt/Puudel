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

var startFood= 25;
var startAnts= 10;
// Objects ----------------------------------------------
function Food(x,y, energy){
    this.x = x;
    this.y = y;
    this.radius = energy;
    this.energy = this.radius*10;

    this.update = () => {
        this.radius -= 0.1 / 60;
        if(this.radius <= 0){
            foods.splice(foods.indexOf(this), 1);
            this.radius = 0;
        }
        this.energy = this.radius*10;
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
    this.mass = 1;
    this.distanceToFood;
    this.health = 1000;
    this.gut = 0;
    this.velocity = {
        x: 0,
        y: 0,
    };


    this.update = () => {
        if (this.gut >= 1){
            this.health += 1 / 60;
            this.gut -= 1 / 60;
        }
        this.health -= (1 + this.velocity.x + this.velocity.y) ;
        //debug
        if(this === ants[0]){
            console.log(this.health);
            console.log(this.gut);
        }

        if(this.health <= 0){
            ants.splice(ants.indexOf(this), 1);
        }
        
        const lastPoint = {
            x: this.x, 
            y: this.y
        };
        // idle detection
        if(this.velocity.x === 0 && this.velocity.y === 0){
            if(this.distanceToFood > 0){
            this.velocity.x = randomIntFromRange(-1, 1) / 5;
            this.velocity.y = randomIntFromRange(-1, 1) / 5;
            }
        }
        // collision detection with food
        foods.forEach(food => {
            this.distanceToFood = getDistance(this.x, this.y, food.x, food.y);
            if(this.distanceToFood - this.radius - food.radius < 0){
                this.velocity.x = 0;
                this.velocity.y = 0;
                if(food.energy > 0){
                    food.radius -= 2 / 60;
                    this.gut += 1 /60;
                }
            }
        });
        
        ants.forEach(ant => {
            if(this === ant) return;
            const distance = getDistance(this.x, this.y, ant.x, ant.y) - this.radius - ant.radius;

            if(distance <= 0){
                console.log('collision');
                resolveCollision(this, ant);
                // if(ant.energy > 0){
                //     ant.energy -= 1;
                //     this.energy += 1;
                // }
                // if(ant.energy <= 0){
                //     ants.splice(ants.indexOf(ant), 1);
                // }
            }
        });




        // Check if the ant goes out of the canvas, wrap around to the other side
        if(this.x + this.radius+1 > canvas.width || this.x - this.radius-1 < 0){
            this.velocity.x = this.velocity.x * -1;
        }
        if(this.y + this.radius+1 > canvas.height || this.y - this.radius-1 < 0){
            this.velocity.y = this.velocity.y * -1;
        }
        
        this.y = this.y + this.velocity.y;
        this.x = this.x + this.velocity.x;
        // move along radians
        

        
        this.draw();
    }
    this.draw = () => {
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        c.fillStyle = this.color;
        c.fill();
        // c.moveTo(lastPoint.x, lastPoint.y);
        // c.lineTo(this.x, this.y);
        
        c.strokeStyle = this.color;
        c.lineWidth = 0.3;
        // c.lineTo(this.x, this.y);
        c.stroke();
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
setInterval(spawnExtraFood, 10000);

function spawnExtraFood(){
    radius = randomIntFromRange(1, 10);
    let x = randomIntFromRange(radius+1, canvas.width - radius-1);
    let y = randomIntFromRange(radius+1, canvas.height - radius-1);

    //prevents food from spawning on top of each other
    for (let j = 0; j < foods.length; j++) {
        if(getDistance(x,y,foods[j].x,foods[j].y) - radius * 2 < 0 ){
            x = randomIntFromRange(radius+1, canvas.width - radius-1);
            y = randomIntFromRange(radius+1, canvas.height - radius-1);
            j = 0;
        }
    }

    foods.push(new Food(
        x,
        y,
        radius)
    );
}
function init() {
    //spawn food
    foods = [];
    for (let i = 0; i < startFood; i++) {
        radius = randomIntFromRange(1, 10);
        let x = randomIntFromRange(radius+1, canvas.width - radius-1);
        let y = randomIntFromRange(radius+1, canvas.height - radius-1);
        
        // prevents ants from spawning on top of each other
        if(i !== 0){
            for (let j = 0; j < foods.length; j++) {
                if(getDistance(x,y,foods[j].x,foods[j].y) - radius * 2 < 0 ){
                    x = randomIntFromRange(radius+1, canvas.width - radius-1);
                    y = randomIntFromRange(radius+1, canvas.height - radius-1);
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
        let x = randomIntFromRange(radius+1, canvas.width - radius-1);
        let y = randomIntFromRange(radius+1, canvas.height - radius-1);
        
       // prevents ants from spawning on top of food    
        if(i === 0){
            for (let j = 0; j < foods.length; j++) {
                if(getDistance(x,y,foods[j].x,foods[j].y) - radius - 20 < 0 ){
                    
                    console.log('recalculating position for ant 0');
                    x = randomIntFromRange(radius+1, canvas.width - radius-1);
                    y = randomIntFromRange(radius+1, canvas.height - radius-1);;
                    j = 0;
                }
            }
        }
        if(i !== 0){
            for (let j = 0; j < ants.length; j++) {
                for (let k = 0; k < foods.length; k++) {
                    if(getDistance(x,y,foods[k].x,foods[k].y) - radius - 20 < 0 ){
                        console.log(`ant ${i} is too close to food ${k}`);
                        x = randomIntFromRange(radius+1, canvas.width - radius-1);
                        y = randomIntFromRange(radius+1, canvas.height - radius-1);
                        k = 0;
                        j = 0;
                    }
                    if(getDistance(x,y,ants[j].x,ants[j].y) - radius - ants[j].radius < 0 ){
                        console.log(`ant ${i} is too close to ant ${j}`);
                        x = randomIntFromRange(radius+1, canvas.width - radius-1);
                        y = randomIntFromRange(radius+1, canvas.height - radius-1);
                        k = 0;
                        j = 0;
                    }
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

    c.fillStyle = 'rgba(255,255,255,1)';
    c.fillRect(0, 0, canvas.width, canvas.height);

    // updates
    ants.forEach(ant => {
        ant.update(); 
    }
    );

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
function rotate(velocity, angle) {
    const rotatedVelocities = {
        x: velocity.x * Math.cos(angle) - velocity.y * Math.sin(angle),
        y: velocity.x * Math.sin(angle) + velocity.y * Math.cos(angle)
    };

    return rotatedVelocities;
}
function resolveCollision(particle, otherParticle) {
    console.log('collision #1');
    const xVelocityDiff = particle.velocity.x - otherParticle.velocity.x;
    const yVelocityDiff = particle.velocity.y - otherParticle.velocity.y;

    const xDist = otherParticle.x - particle.x;
    const yDist = otherParticle.y - particle.y;

    // Prevent accidental overlap of particles
    if (xVelocityDiff * xDist + yVelocityDiff * yDist >= 0) {
        console.log('collision #2');

        // Grab angle between the two colliding particles
        const angle = -Math.atan2(otherParticle.y - particle.y, otherParticle.x - particle.x);
        console.log(angle);
        // Store mass in var for better readability in collision equation
        const m1 = particle.mass;
        const m2 = otherParticle.mass;

        // Velocity before equation
        console.log('collision #3');
        const u1 = rotate(particle.velocity, angle);
        const u2 = rotate(otherParticle.velocity, angle);
        console.log('collision #4');
        // Velocity after 1d collision equation
        const v1 = { x: u1.x * (m1 - m2) / (m1 + m2) + u2.x * 2 * m2 / (m1 + m2), y: u1.y };
        const v2 = { x: u2.x * (m1 - m2) / (m1 + m2) + u1.x * 2 * m2 / (m1 + m2), y: u2.y };

        // Final velocity after rotating axis back to original location
        const vFinal1 = rotate(v1, -angle);
        const vFinal2 = rotate(v2, -angle);

        // Swap particle velocities for realistic bounce effect
        particle.velocity.x = vFinal1.x;
        particle.velocity.y = vFinal1.y;

        otherParticle.velocity.x = vFinal2.x;
        otherParticle.velocity.y = vFinal2.y;
    }
}
// Start Stuff ----------------------------------------------
init();
animate();