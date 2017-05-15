
Vue.component('dropdown-time', {
  props: ['name', 'value'],
  data: function() {
    return {
      times: [
        {key:'', value:''},
        {key: '00:00', value: '12:00 am'},
        {key: '01:00', value: '1:00 am'},
        {key: '02:00', value: '2:00 am'},
        {key: '03:00', value: '3:00 am'},
        {key: '04:00', value: '4:00 am'},
        {key: '05:00', value: '5:00 am'},
        {key: '06:00', value: '6:00 am'},
        {key: '07:00', value: '7:00 am'},
        {key: '08:00', value: '8:00 am'},
        {key: '09:00', value: '9:00 am'},
        {key: '10:00', value: '10:00 am'},
        {key: '11:00', value: '11:00 am'},
        {key: '12:00', value: '12:00 pm'},
        {key: '13:00', value: '1:00 pm'},
        {key: '14:00', value: '2:00 pm'},
        {key: '15:00', value: '3:00 pm'},
        {key: '16:00', value: '4:00 pm'},
        {key: '17:00', value: '5:00 pm'},
        {key: '18:00', value: '6:00 pm'},
        {key: '19:00', value: '7:00 pm'},
        {key: '20:00', value: '8:00 pm'},
        {key: '21:00', value: '9:00 pm'},
        {key: '22:00', value: '10:00 pm'},
        {key: '23:00', value: '11:00 pm'}
      ]
    }
  },
  created: function(){
    this.selectedOption = this.value;
  },
  template: "<select :name='name' v-model='selectedOption' class='form-control'><option v-for='time in times' :value='time.key'>{{ time.value }}</option></select>"
});

Vue.filter('formatDate', function(value) {
  if (value instanceof moment === false) {
    value = moment(value, "YYYY-MM-DD");
  }
  return value.format('DD MMM YYYY');
});

Vue.filter('formatTime', function(value) {
  if (typeof value === "undefined" || value === "") {
    return '';
  }
  if (value instanceof moment === false) {
    value = moment(value, "HH:mm:ss");
  }
  return value.format('h:mma');
});

function validateTicketForm() {
  var validate = true;
  $(".select-time").each(function() {
    var time = $(this).val();
    //console.log('time='+time);
    if (time == '') {
      $(this).addClass("txt-error");
      validate = false;
    } else {
      $(this).removeClass("txt-error");
    }
  });
  console.log('validateTicketForm = ' + validate);
  if (validate == false) {
    toastr.error("Select time");
  }
  return validate;
}
