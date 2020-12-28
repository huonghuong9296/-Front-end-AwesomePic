window.onload = function(){
    var input = document.getElementById('btn-profile');
    var clickCounter = 0;
      input.onclick = function () {
        clickCounter++;
        if (clickCounter % 2 == 1) {
            document.getElementById("myForm").style.display = "block";
        }
        else{
            document.getElementById("myForm").style.display = "none";
        }
    };
}