function readURL(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-preview");
        document.getElementById("disapear").style.display = "none";
        preview.src = src;
        preview.style.display = "inline-block";
        preview.style.width = "70px";
        preview.style.height = "70px";
    }
}

function readURL2(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file2-preview");
        document.getElementById("disapear2").style.display = "none";
        preview.src = src;
        preview.style.display = "inline-block";
        preview.style.width = "70px";
        preview.style.height = "70px";
    }
}


// let disapear = document.getElementById("file");
// disapear.addEventListener("input", function() {
    
// });

// let disapear2 = document.getElementById("file2");
// disapear.addEventListener("input", function() {
    
// });