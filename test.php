<html>
<head>
<script src="https://cdn.rawgit.com/showdownjs/showdown/1.0.1/dist/showdown.min.js"></script>
<style>
blockquote
{
    background: whitesmoke;
}

code
{
    background: #000;
    color: white;
    padding: 1px;
    width: 500px;
}
</style>
</head>
<body>
<textarea id="sourceTA" rows="10" cols="82">
_Rajan_
</textarea>
<hr/>
<button id="runBtn" onClick="run()">Convert</button>
<hr/>
<div id="targetDiv"></div>
<script>
function run() {
  var text = document.getElementById('sourceTA').value,
      target = document.getElementById('targetDiv'),
      converter = new showdown.Converter(),
      html = converter.makeHtml(text);
    alert(html);
    target.innerHTML = html;
}
</script>

511164054521-iim6ian4hjve1bg2gacsh10k79nl5kik.apps.googleusercontent.com


K0ljCtLue5w4PPVSDN6v9svG
</body>
</html>