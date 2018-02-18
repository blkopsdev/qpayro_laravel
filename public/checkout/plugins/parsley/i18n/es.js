// ParsleyConfig definition if not already set
// Validation errors messages for Parsley
$(function(){
Parsley.addMessages('es', {
  defaultMessage: "Este valor no ser inválido.",
  type: {
    email: "Ingresa un dirección de correo electrónico válida.",
    url: "Ingresa una URL válida.",
    number: "Ingresa un número válido.",
    integer: "Ingresa un número entero válido.",
    digits: "Ingresa un dígito válido.",
    alphanum: "Ingresa un valor alfanumérico."
  },
  notblank: "Este valor no debe estar en blanco.",
  required: "Campo requerido.",
  pattern: "Valor incorrecto.",
  min: "Ingresa un valor menor que %s.",
  max: "Ingresa un valor mayor que %s.",
  range: "Ingresa un valor entre %s y %s.",
  minlength: "Valor incorrecto. La longitud mínima es de %s caracteres.",
  maxlength: "Valor incorrecto. La longitud máxima es de %s caracteres.",
  length: "La longitud de este valor debe estar entre %s y %s caracteres.",
  mincheck: "Debes seleccionar al menos %s opciones.",
  maxcheck: "Debes seleccionar %s opciones o menos.",
  check: "Debes seleccionar entre %s y %s opciones.",
  equalto: "Este valor debe ser idéntico",
  creditcard: "Tarjeta inválida o no soportada por la pasarela de pago",
  expirydate: "Fecha de expiración inválida",
  cvv: "Código de seguridad inválido"
});

Parsley.setLocale('es');
});


