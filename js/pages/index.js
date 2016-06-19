// Populate Forms
function random() {
  var randname = chance.first();
  document.register.fName.value = randname;
  document.register.lName.value = chance.last();
  document.register.username.value = randname;

  document.register.phone.value = chance.string({length: 9, pool: '1234567890'});
  document.register.email.value = chance.email();


  document.register.password.value = "password";
  document.register.confirm_password.value = "password";

  document.register.street.value = chance.address();
  document.register.city.value = chance.city();
  document.register.zip.value = chance.zip();
  document.register.country.value = chance.country({ full: true });

  $(document).ready(function() {
  Materialize.updateTextFields();
  });

  Materialize.toast("Password is: password", 6000 );
}
