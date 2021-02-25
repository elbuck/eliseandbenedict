document.addEventListener('DOMContentLoaded', () => {

// Drop down nav-bar

const dropDownButton = document.querySelector('.nav-drop-down')
const navList = document.querySelector('.drop-down-list')

function toggleButton () {
  navList.classList.toggle('show')
}

dropDownButton.addEventListener('click', toggleButton)

// Hide drop down nav-bar when click outside of it

window.addEventListener('click', function (event) {
  if (event.target != dropDownButton && event.target.parentNode != dropDownButton) {
    navList.classList.remove('show')
  }
});


// Countdowwn to wedding date
const today = new Date ()

const Wedding = new Date('2021-10-20T21:58:01.532Z')

const countdown = document.querySelector('.countdown')

const millisecondsToWedding = (Wedding - today)
const days = millisecondsToWedding / 86400000

countdown.innerHTML = Math.round(days)

// main page menu sticky
window.onscroll = function() {myFunction()};
const navbar = document.getElementById("navbar");
const sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
//


})