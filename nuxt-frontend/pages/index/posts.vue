<template>
  <div>
    posts {{ p }}
  </div>
</template>

<script>
export default {
  props: {
    p: {
      type: String,
      default: null,
    },
  },
}
</script>

<style></style>