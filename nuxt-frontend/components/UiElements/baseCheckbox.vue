<template>
  <v-col cols="3">
    <v-checkbox
      v-bind="$attrs"
      @change="$emit('input',$event)"
    />
  </v-col>
</template>

<script>
export default {
  props: {
    value: {
      type: [Number, String, Boolean],
      default: null,
    },
  },
  mounted() {
    console.log(this.value)
  },
}
</script>

<style></style>