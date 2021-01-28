import Vue from 'vue'
import { get } from 'lodash'
import { mapGetters, mapActions } from 'vuex'

const Validation = {
  install(Vue) {
    Vue.mixin({
      computed: mapGetters({
        $errors: 'validation/errors',
      }),
      methods: {
        ...mapActions({
          $clearError: 'validation/clearError',
          $setErrors: 'validation/setErrors',
        }),
        $hasError(name) {
          return !!get(this.$errors, name)
        },
        $getErrors(name) {
          return get(this.$errors, name, [])
        },
        // $validate(data, rules, customErrorMessages) {
        //   customErrorMessages = {
        //     ...this.$t('validation.rules'),
        //     ...customErrorMessages
        //   }

        //   const attributes = mapValues(rules, (value, key) =>
        //     toLower(this.$t(`page.inquiries.headers.${key}`))
        //   )

        //   const validation = this.$validator(data, rules, customErrorMessages)

        //   validation.setAttributeNames(attributes)

        //   if (validation.fails()) {
        //     this.$setErrors(validation.errors.all())
        //     this.$danger(this.$t('validation.message'))
        //     return false
        //   }

        //   return true
        // }
      },
    })
  },
}

Vue.use(Validation)
