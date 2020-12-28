var option1 = document.getElementById('option-1');
var option2 = document.getElementById('option-2');
var option3 = document.getElementById('option-3');

option1.addEventListener('click', (e) => {
  console.log(e.target);
  document.getElementById('pricing-package').innerHTML = '$15';

  option3.classList.remove('option-choose');
  option2.classList.remove('option-choose');
  option1.classList.add('option-choose');
});

option2.addEventListener('click', (e) => {
  console.log(e.target);
  document.getElementById('pricing-package').innerHTML = '$30';
  option3.classList.remove('option-choose');
  option1.classList.remove('option-choose');
  option2.classList.add('option-choose');
});
option3.addEventListener('click', (e) => {
  console.log(e.target);
  document.getElementById('pricing-package').innerHTML = '$50';
  option1.classList.remove('option-choose');
  option2.classList.remove('option-choose');
  option3.classList.add('option-choose');
});
