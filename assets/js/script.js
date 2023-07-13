//Customize your Notification  
const config = {
    timeout: 5000,
    positionY: "bottom", // top or bottom
    positionX: "right", // right left, center
    distanceY: 30, // Integer value
    distanceX: 30, // Integer value
    zIndex: 100, // Integer value
    theme: "ligh", // default, ligh or  dark (leave empty for "default" theme)
    duplicates: false // true or false - by default it's false
};



//Create a new Toastmejs class instance
window = toast = new Toastme(config);