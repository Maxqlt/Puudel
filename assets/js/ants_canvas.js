// Import the seedrandom function from the seedrandom library
import seedrandom from 'seedrandom';

console.log(randomIntFromRange(1,2));


// Canvas ----------------------------------------------
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
// non canvas variables

let startTime = Date.now();
let animationFrameId;

function updateAntsList() {
    const listContainer = document.getElementById("ants");
    if (listContainer !== null) {
        var listHTML = "<ul>";
    
        for (var i = 0; i < ants.length; i++) {
        listHTML += `<li >
            <p>Ant #` + i + `: ` + ants[i].health.toFixed(0)+`</p><br>
             <div style="background-color: `+ants[i].color +`; width: ` + ants[i].health.toFixed(0)/10+`px"><div>
            </li>`;
        }
    
        listHTML += "</ul>";
        if(ants.length > 0){
            listContainer.innerHTML = listHTML;
        }else{
            listContainer.innerHTML = "All ants are dead";
        }
    }
  }
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
let paused = false;
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
var id = 0;
var antGenome = {
    // canvas related properties
    size: 0,
    growthRate: 0,
    // movement related properties
    speed: 0,
    acceleration: 0,
    // sensory properties
    senseRadius: 0,
    // Biological properties
    health: 0,
    gut: 0,
    metabolism: 0,
    fertility: 0,
    fear: 0,
    aggression: 0,
    strength: 0,
    color: 0,
};
var startFood= 10;
var startAnts= 50;
// Objects ----------------------------------------------
function Food(x,y, energy){
    this.x = x;
    this.y = y;
    this.startingEnergy = energy*10;
    this.radius = energy;
    this.energy = this.radius*10;

    this.update = () => {
        this.radius -= 0.1 / 180;
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
        // Display energy value in the middle of the circle
        c.font = '9px Arial';
        c.fillStyle = 'black';
        c.textAlign = 'center';
        c.textBaseline = 'middle';
        const percentage = Math.floor(this.energy);
        c.fillText(percentage, this.x, this.y);
  
    }
}
function Ant(id,x,y,genome){
    //canvas related properties
    this.id = id;
    this.genome = genome;
    this.x = x;
    this.y = y;
    this.radius = 1+ genome.size*5;
    this.color = genome.color;
    this.speed = 10 * genome.speed;
    this.metabolism = genome.metabolism;
    this.growthRate = genome.growthRate;
    this.healthFactor = 1+genome.health;
    this.velocity = {
        x: 0,
        y: 0,
    };
    // sensory properties
    this.senseRadius = this.radius * 2;
    this.senseRadiusFactor = genome.senseRadius;
    this.distanceToFood;
    // Biological properties
    this.health = this.radius * this.healthFactor* 1000;
    this.maximalHealth = this.health;
    this.gutfactor = 1+genome.gut;
    this.gut = 0;
    this.gutCapacity = this.radius*100;
    

    // dont edit these properties
    this.mass = 1;


    this.update = () => {
        // canvas related updates
        const lastPoint = {
            x: this.x, 
            y: this.y
        };

    // natrural ageing/starvation/growth
        // ageing
        this.health -= 2*this.metabolism;
        this.maximalHealth = this.radius * this.healthFactor* 1000;
        this.senseRadius = this.radius * (2+1/this.radius) * (1+this.senseRadiusFactor*2);
        
        //growth
        if(this.health > 0.5*this.maximalHealth && this.gut >= 0.7*this.gutCapacity){
            this.radius += this.growthRate*1;
            this.health -= this.metabolism/10+2;
            this.gut = 0;
            this.health -= this.maximalHealth/10;
        }
        // cost of digesting
        if (this.gut >= 10 && this.health <= this.maximalHealth-10){
            this.health += 50 * this.gutfactor; 
            this.gut -= 5 ;
        }

        
        //Moving energy cost
        if(this.velocity.x !== 0 || this.velocity.y !== 0){
            this.health -= 4*Math.abs(this.velocity.x)/this.metabolism + 4*Math.abs(this.velocity.y)*this.metabolism;
        }
        
        
        // death
        if(this.health <= 0){
            ants.splice(ants.indexOf(this), 1);
        }


        //debug
        // if(this === ants[0]){
        //     console.log(this.health);
        //     console.log(this.gut);
        // }

        
        
        
        // idle detection -> random movement
        if(this.velocity.x === 0 && this.velocity.y === 0){
            if(this.distanceToFood > 0){
            this.velocity.x = randomIntFromRange(-1, 1) / 5 * this.speed;
            this.velocity.y = randomIntFromRange(-1, 1) / 5  * this.speed;
            }
        }
        // movement
       
        // interaction with food
        foods.forEach(food => {
            this.distanceToFood = getDistance(this.x, this.y, food.x, food.y);
            // sense food
            if(this.distanceToFood - this.senseRadius - food.radius < 0 && this.gut < this.gutCapacity*0.8){
                // select closest food
                var closestFood = food;
                for (let i = 0; i < foods.length; i++) {
                    if(getDistance(this.x, this.y, foods[i].x, foods[i].y) < getDistance(this.x, this.y, closestFood.x, closestFood.y)){
                        closestFood = foods[i];
                    }
                }
                // move towards food
                const angle = Math.atan2(closestFood.y - this.y, closestFood.x - this.x);
                this.velocity.x = Math.cos(angle) / 5 * this.speed;
                this.velocity.y = Math.sin(angle) / 5 * this.speed;
            }
            //collision
            if(this.distanceToFood - this.radius - food.radius < 0){
                this.velocity.x = 0;
                this.velocity.y = 0;
                // eat food
                if(food.energy > 0 && this.gut < this.gutCapacity-10){
                    food.radius -= 1 / 10;
                    if (this.gut <= 401){
                        this.gut += 10;
                    }
                }
            }
        });
        
        // collision detection with other ants
        ants.forEach(ant => {
            if(this === ant) return;
            const distance = getDistance(this.x, this.y, ant.x, ant.y) - this.radius - ant.radius;

            if(distance <= 0){
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
        

        // draw sensory radius
        c.beginPath();
        c.arc(this.x, this.y, this.senseRadius, 0, Math.PI * 2, false);
        // yellow color with 0.1 opacity
        c.fillStyle = 'rgba(255,0,0,0.2)';
        c.fill();

        const healthBarHeight = 5;
        const gutBarHeight = 5;
        const totalBarWidth = 20; // Total width of the bars

        // Draw gut bar
        c.fillStyle = 'red'; // Color for gut bar
        c.fillRect(this.x - totalBarWidth / 2, this.y + 5, (this.gut / 500) * totalBarWidth, gutBarHeight);
        // draw gut bar outline
        c.beginPath();
        c.rect(this.x - totalBarWidth / 2, this.y + 5, totalBarWidth, gutBarHeight);
        c.strokeStyle = 'black';
        c.stroke();


        // Draw health bar
        c.fillStyle = 'green'; // Color for health bar
        c.fillRect(this.x - totalBarWidth / 2, this.y - 5, (this.health / this.maximalHealth) * totalBarWidth, healthBarHeight);
        // draw health bar outline
        c.beginPath();
        c.rect(this.x - totalBarWidth / 2, this.y - 5, totalBarWidth, healthBarHeight);
        c.strokeStyle = 'black';
        c.stroke();

        // display id as text in middle
        // c.font = '12px Arial';
        // c.fillStyle = 'black';
        // c.textAlign = 'center';
        // c.textBaseline = 'middle';
        // c.fillText(id, this.x, this.y);





    }
}


// decalres Objects
let ants = [];
let foods = [];
let newGen = [];
// Functions ----------------------------------------------
 // Function to start the animation
 function startAnimation() {
    startTime = Date.now();
    animate();
    updateTimer();
}
function pauseAnimation() {
    paused = !paused;
    console.log(ants);
    if(paused === false){
        animate();
    }
}
setInterval(spawnExtraFood, 2500);

function spawnExtraFood(){
    let radius = randomIntFromRange(1, 10);
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
    spawnAnts(startAnts, 0, ants);
    
}
function animate() {
    //loop
    if(paused === false){

        requestAnimationFrame(animate);
        updateTimer();
        updateAntsList();
        
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
        // console.log(ants);
        if(ants.length <= 1){
            nextGeneration();
        }
    }
}
function spawnAnts(amount=1, genome=0,array=ants){
    var usedGenome = genome;
    for (let i = 0; i < amount; i++) {
        radius = randomIntFromRange(1, 25);
        let x = randomIntFromRange(radius+1, canvas.width - radius-1);
        let y = randomIntFromRange(radius+1, canvas.height - radius-1);

        //prevents ants from spawning on top of each other
        
        for (let j = 0; j < ants.length; j++) {
            if(getDistance(x,y,ants[j].x,ants[j].y) - radius - ants[j].radius < 0 ){
                x = randomIntFromRange(radius+1, canvas.width - radius-1);
                y = randomIntFromRange(radius+1, canvas.height - radius-1);
                j = 0;
            }
        }
        if(usedGenome === 0){
            console.log('new genome');
            usedGenome = createAntGenome();
        }else{
            for (information in genome){
                console.log('mutation');
                genome[information] = information + Math.random() *2 - 1;
            }
            usedGenome = genome;
        }

        array.push(new Ant(
            id++,
            x,
            y,
            usedGenome)
        );
        usedGenome = genome;
    }
}

function nextGeneration(){
    console.log('next generation');
    // reset food
    foods = [];
    for (let i = 0; i < startFood; i++) {
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
        console.log('food created');
        foods.push(new Food(
            x,
            y,
            radius)
        );
    }
    var heriatge = ants[0].genome;

    // create similar ants
    spawnAnts(25,heriatge, newGen);

    // create new ants
    // spawnAnts(startAnts, createAntGenome(), newGen);
    ants = [];
    ants = newGen;
}

function createAntGenome() {
    for(propperty in antGenome){
        antGenome[propperty] = Math.random();
    }
    return antGenome;
}
// Utility Functions ----------------------------------------------
// function randomIntFromRange(min, max) {
//     return Math.floor(Math.random() * (max - min + 1) + min);
// }
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
    const xVelocityDiff = particle.velocity.x - otherParticle.velocity.x;
    const yVelocityDiff = particle.velocity.y - otherParticle.velocity.y;

    const xDist = otherParticle.x - particle.x;
    const yDist = otherParticle.y - particle.y;

    // Prevent accidental overlap of particles
    if (xVelocityDiff * xDist + yVelocityDiff * yDist >= 0) {

        // Grab angle between the two colliding particles
        const angle = -Math.atan2(otherParticle.y - particle.y, otherParticle.x - particle.x);
        // Store mass in var for better readability in collision equation
        const m1 = particle.mass;
        const m2 = otherParticle.mass;

        // Velocity before equation
        const u1 = rotate(particle.velocity, angle);
        const u2 = rotate(otherParticle.velocity, angle);
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
createAntGenome();