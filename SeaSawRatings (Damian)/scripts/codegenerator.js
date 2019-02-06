// codegenerator.js

function codeGenerator() {
  var code = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  for( var i=0; i < 9; i++ )
      code += possible.charAt(Math.floor(Math.random() * possible.length));
  return code;
}
