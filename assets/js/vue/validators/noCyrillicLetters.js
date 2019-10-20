import * as helpers from 'vuelidate/lib/validators/common'
export default helpers.withParams({type: 'noLatinLetters'}, function(value) {
    return !helpers.req(value) || /^[^А-Яа-я]*$/g.test(value);
});
