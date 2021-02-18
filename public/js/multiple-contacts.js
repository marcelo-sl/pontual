$(document).on('click', '#addPhone', function() {
  let divContacts = $(this).closest( "#contacts" );
  let contact = divContacts.find('.contact-row').last();

  addPhone(contact, 3);
});

$(document).on('click', '.removePhone', function() {
  let contactToRemove = $(this).closest('.contact-row');

  if ($('.contact-row').length > 1) {
    remove(contactToRemove);
  }

  return;
});


function addPhone(contactRow, limit) {
  if (limit > $('.contact-row').length) {
    let contactCloned = clone(contactRow);
  
    cleanFields(contactCloned);
    remask(contactCloned);
  }
  
  return;
}

function clone(element) {
  let elementCloned = element.clone().appendTo('#contacts-place');

  return elementCloned;
}

function remove(element) {
  element.remove();
  return;
}

function remask(divCloned) {
  divCloned.find('input').mask(SPMaskBehavior, spOptions);
  return;
}

function cleanFields(divCloned) {
  divCloned.find('input').val('');
  return;
}

var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
