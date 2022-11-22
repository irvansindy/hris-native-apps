<!DOCTYPE html>
<html>
<head>
<title>Belajar Font External CSS</title>
 
<style type="text/css">
   @font-face {
         font-family: "Font Digital";
         src: url('SourceSansPro-Light.otf');
         }
 
   .digital {
         font-family: "Font Digital";
         }
</style>
 
</head>
  
<body>
   <h2>Belajar Font External CSS</h2>
   <h3>Font reguler:</h3>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
   Nulla erat dolor, ullamcorper in ultricies eget, 
   fermentum rhoncus leo. Curabitur eu mi vitae metus 
   posuere laoreet.</p>
   <h3>Font external (digital):</h3>
   <p class="digital">Lorem ipsum dolor sit amet, consectetur 
   adipiscing elit. Nulla erat dolor, ullamcorper in ultricies eget, 
   fermentum rhoncus leo. Curabitur eu mi vitae 
   metus posuere laoreet.</p>
</body>
</html>