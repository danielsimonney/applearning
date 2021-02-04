<template>
  <v-card-text class="pl-0 d-flex flex-row align-center">
    <div
      class="containAvatar rounded-circle"
    >
      <div class="greenTick">
        <v-icon color="#38C31C">
          mdi-check-circle
        </v-icon>
      </div>
      <v-avatar
        class="my-1 mx-1 pa-2"
        color="indigo"
        size="30"
      >
        <span class="white--text title">
          DS
        </span>
      </v-avatar>
    </div>
    <div class="d-flex flex-column ml-4">
      {{ post.user.email }}
      <p class="font-weight-thin mb-0">
        {{ post.created_at }}
      </p> 
    </div>
    <div
      class="green lighten-5 green--text rounded-pill px-2 ml-3 mb-4"
    >
      Best answer
    </div>
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
}
</script>

<style scoped>
.containAvatar {
  border: solid #38c31c 2px;
}

.greenTick {
  position: absolute;
  top: 44px;
  left: 61px;
  z-index: 1000;
}
</style>