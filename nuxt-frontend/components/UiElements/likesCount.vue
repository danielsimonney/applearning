<template>
  <div class="text-center">
    <v-icon
      :color="(userLike==true) ? 'blue' : 'grey'"
      @emit="addLike"
    >
      mdi-arrow-up
    </v-icon>
    <p
      class="my-2"
      :class="(userLike==false) ? 'red--text' : (userLike==true) ? 'blue--text' : 'grey--text'"
    >
      {{ likescount }}
    </p>
    <v-icon
      :color="(userLike==false) ? 'red' : 'grey'"
      @click="decreaseLike"
    >
      mdi-arrow-down
    </v-icon>
  </div>
</template>

<script>
export default {}
</script>

<style></style>