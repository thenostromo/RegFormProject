import * as helpers from 'vuelidate/lib/validators/common'
export default helpers.withParams({type: 'engCharsNumbersAndPunctuation'}, function(value) {
    return !helpers.req(value) || /^[A-Za-z0-9_.-]*$/g.test(value);
});
