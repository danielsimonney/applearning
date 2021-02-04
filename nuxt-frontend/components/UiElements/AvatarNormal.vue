<template>
  <v-card-text class="pl-0 d-flex flex-row align-center">
    <v-avatar
      class="my-1 mx-1 pa-2"
      color="indigo"
      size="30"
    >
      <span class="white--text title">
        <slot
          name="username"
          v-bind="{user: post.user}"
        >DS</slot>
      </span>
    </v-avatar>
    <slot />
  </v-card-text> 
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      default: null,
    },
  },
  mounted() {
    console.log(this.post)
  },
}
</script>

<style></style>