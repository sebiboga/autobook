<html>
<head>
<script>
function showHint() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "https://autobook.space/lab/api/guid/", true);
        xmlhttp.send();
}
</script>
</head>
<body>

<button onclick="showHint()"> genereaza guid </button>
<p>guid: <span id="txtHint"></span></p>
</body>
</html>