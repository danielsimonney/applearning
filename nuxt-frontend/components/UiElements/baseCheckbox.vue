<template>
  <v-checkbox
    v-model="selected"
    v-bind="$attrs"
    :value="value"
  />
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      default: () => [],
    },
    targetValue: {
      type: [Array, String, Boolean, Number],
      default: null,
    },
  },
  data() {
    return {
      selected: [],
    }
  },
  mounted() {
    this.$nextTick(function () {
      // this.selected = this.targetValue
    })
    // console.log(this.tagsArray)
  },
  methods: {
    update() {
      this.$emit('input', this.selected)
    },
  },
}
</script>

<style></style>