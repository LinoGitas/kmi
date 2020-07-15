const item = document.querySelector(".result");

if (item) {
    setTimeout(function(){ 
        item.style.display = "none"; 
        document.getElementById("ugis").value = '0.00';
        document.getElementById("svoris").value = '';
    }, 3000);
}