<template>
  <v-btn
    class="btn-basic"
    depressed
    v-bind="$attrs"
    @click="$emit('click', $event)"
  >
    <v-icon class="mr-3">
      <slot />
    </v-icon>
    {{ text }} 
  </v-btn>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: null,
    },
    text: {
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
<style scoped>
.btn-basic {
  font-size: 15px;
  border-radius: 10px;
}
</style>