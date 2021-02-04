<template>
  <v-text-field
    :value="value"
    outlined
    v-bind="$attrs"
    @input="$emit('input',$event)"
  />
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: null,
    },
  },
  data() {
    return {}
  },
  computed: {},
  mounted() {},
}
</script>


