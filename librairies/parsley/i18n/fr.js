// ParsleyConfig definition if not already set
window.ParsleyConfig = window.ParsleyConfig || {};
window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

// Define then the messages
window.ParsleyConfig.i18n.fr = $.extend(window.ParsleyConfig.i18n.fr || {}, {
  defaultMessage: "Cette valeur semble non valide.",
  type: {
    email:        "Veuillez saisir une adresse mail valide svp.",
    url:          "Cette valeur n'est pas une URL valide.",
    number:       "Cette valeur doit être un nombre.",
    integer:      "Cette valeur doit être un entier.",
    digits:       "Cette valeur doit être numérique.",
    alphanum:     "Cette valeur doit être alphanumérique."
  },
  notblank:       "Cette valeur ne peut pas être vide.",
  required:       "Vous devez remplir ce champ.",
  pattern:        "Cette valeur semble non valide.",
  min:            "Cette valeur ne doit pas être inféreure à %s.",
  max:            "Cette valeur ne doit pas excéder %s.",
  range:          "Cette valeur doit être comprise entre %s et %s.",
  minlength:      "La chaîne est trop courte. Elle doit avoir au minimum %s caractères.",
  maxlength:      "La chaîne est trop longue. Elle doit avoir au maximum %s caractères.",
  length:         "Cette valeur doit contenir entre %s et %s caractères.",
  mincheck:       "Vous devez sélectionner au moins %s choix.",
  maxcheck:       "Vous devez sélectionner %s choix maximum.",
  check:          "Vous devez sélectionner entre %s et %s choix.",
  equalto:        "Cette valeur devrait être identique"
});

// If file is loaded after Parsley main file, auto-load locale
if ('undefined' !== typeof window.ParsleyValidator)
  window.ParsleyValidator.addCatalog('fr', window.ParsleyConfig.i18n.fr, true);
