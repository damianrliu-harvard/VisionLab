Array.prototype.multisplice = function(){
    var args = Array.apply(null, arguments);
    args.sort(function(a, b){
        return a - b;
    });
    for(var i = 0; i < args.length; i++){
        var index = args[i] - i;
        this.splice(index, 1);
    }
}

Array.prototype.multislice = function(ranges) {
	if(typeof ranges === 'undefined')
		throw Exception("Ranges have to be defined!");
	if(typeof ranges !== 'object')
		throw Exception("You have to pass an array!");

	return ranges.map(el => this.slice(el.from, el.to));
};

siftByLabels = function (indices) {
  return function(string) {
    return indices.some(el => string.includes(el))
  };
};
