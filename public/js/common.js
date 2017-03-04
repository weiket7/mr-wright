function getSelectedCheckboxesByName(name) {
  var data = [];
  $. each($("input[name='"+name+"']:checked"), function(){
    data.push($(this). val());
  });
  return data;
}

function getSelectedMultiSelect2ById(id) {
  var data = $("#"+id).select2('data');
  var res = [];
  for(var i=0; i<data.length; i++) {
    res.push(data[i].id);
  }
  return res;
}

function pushToObject(obj, key, value) {
  if (typeof obj[key] === "undefined") {
    obj[key] = [value];
  } else {
    var exist = arrayContains(obj[key], value);
    if (! exist) {
      obj[key].push(value);
    }
  }
}

function removeFromObject(obj, key, value) {
  if (typeof obj[key] === "undefined") {
    return;
  }
  for(var i=0; i<obj[key].length; i++) {
    if (obj[key][i] === value) {
      obj[key].splice(i, 1);
    }
  }
}

function arrayContains(arr, value) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == value) {
      return true;
    }
  }
  return false;
}