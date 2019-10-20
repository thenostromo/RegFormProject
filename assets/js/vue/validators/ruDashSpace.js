import * as helpers from 'vuelidate/lib/validators/common'
export default helpers.withParams({type: 'ruDashSpace'}, function(value) {
    return !helpers.req(value) || /^([А-Яа-яёЁ\-\s]+)$/g.test(value);
});
