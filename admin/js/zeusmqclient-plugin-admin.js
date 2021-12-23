(function( $ ) {
  'use strict';

  function convertToArray(nodeList) {
    return Array.prototype.slice.call(nodeList);
  }

  function getCheckedRadioButtons(target) {
    return target.querySelector('input[type="radio"]:checked');
  }

  function show(target) {
    var classList = target.classList;

    if (classList.contains('hidden') === true) {
      classList.remove('hidden');
      return;
    }
  }

  function hide(target) {
    var classList = target.classList;

    if (classList.contains('hidden') === false) {
      classList.add('hidden');
      return;
    }
  }

  function resetRadio(button) {
    if (button.value === "false") {
      button.checked = true;
      return;
    }

    button.checked = false;
  }

  function reset(fields) {
    fields.forEach(function(field) {
      if (field.type !== 'radio') {
        field.value = "";
        return;
      }

      resetRadio(field);
    });
  }
})( jQuery );
