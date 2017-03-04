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