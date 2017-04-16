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
  value = value.toLowerCase();
  for(var i=0; i<arr.length; i++) {
    var v = arr[i].toLowerCase();
    if (v == value) {
      return true;
    }
  }
  return false;
}

function fileExtensionIsImage(file_name) {
  file_name = file_name.toLowerCase();
  var extension = file_name.split('.')[1];
  var image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
  return image_extensions.indexOf(extension) >= 0;
}

function fileMimeIsImage(file_mime) {
  file_mime = file_mime.toLowerCase();
  var image_mimes = ["image/jpeg", "image/png", "image/gif"];
  return image_mimes.indexOf(file_mime) >= 0;
}

function fileExtensionIsVideo(file_name) {
  file_name = file_name.toLowerCase();
  var extension = file_name.split('.')[1];
  var video_extensions = ['wmv', 'avi', 'flv', 'mp4', 'mov'];
  return video_extensions.indexOf(extension) >= 0;
}

function validateTime(value) {
  value = value.trim();

  //https://www.mkyong.com/regular-expressions/how-to-validate-time-in-12-hours-format-with-regular-expression/
  //http://stackoverflow.com/questions/41758187/invalid-group-in-regular-expression
  //var timeRegex = /^(1[012]|[1-9]):[0-5][0-9](\\s)?(?i)(am|pm)$/; //not working version
  var timeRegex = /^(1[012]|[1-9]):[0-5][0-9]\s?(am|pm)$/i;
  return timeRegex.test(value);
}