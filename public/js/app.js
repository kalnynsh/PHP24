$(function() {
  $("[type='submit']").on('click', function() {
    var submit_add_to_cart = 0;
    var submit_edit_cart = 0;

    if ($(this).attr('name') === 'submit_add_to_cart') {
      submit_add_to_cart = 1;
    } else if ($(this).attr('name') === 'submit_edit_cart') {
      submit_edit_cart = 1;
    }

    var id = $(this)
      .parent()
      .find('input[name="id"]')
      .val();
    var amount = $(this)
      .parent()
      .find('input[name="amount"]')
      .val();

    $.ajax({
      url: 'add_to_cart.php',
      type: 'POST',
      data: {
        submit_add_to_cart: submit_add_to_cart,
        submit_edit_cart: submit_edit_cart,
        id: id,
        amount: amount
      }
    })
      .done(function(response) {
        var result = JSON.parse(response);
        if (result.status == 'ok') {
          alert(result.message);
        }
      })
      .fail(function(error) {
        console.log('Error from AJAX: ' + error);
      });
  });
});
