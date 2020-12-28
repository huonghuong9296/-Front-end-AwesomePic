var sidebar = document.getElementById('sidebar');
var openSidebar = document.getElementById('menu-button');
var overlay = document.getElementsByClassName('overlay')[0];

sidebar.addEventListener('click', (e) => {
  console.log(e.target);
});

openSidebar.addEventListener('click', (e) => {
  console.log(e.target);
  sidebar.classList.remove('hide-menu');
  // overlaySidebar.classList.remove('hide-menu');
  sidebar.classList.add('show-menu');
  // overlaySidebar.classList.add('show-menu');
  overlay.classList.add('display');
  overlay.classList.remove('hidden');
});

window.addEventListener('click', (e) => {
  console.log(e.target);
  var check = sidebar.contains(e.target);
  if (!check && !e.target.contains(openSidebar)) {
    sidebar.classList.remove('show-menu');
    console.log(sidebar.classList);
    sidebar.classList.add('hide-menu');
    overlay.classList.remove('display');
    overlay.classList.add('hidden');
  }
});
