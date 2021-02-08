<template>
  <v-dialog
    :value="true"
    persistent
    max-width="290"
  >
    <v-card>
      <v-card-title class="headline">
        {{ title }}
      </v-card-title>
      <v-card-text>{{ answer }}</v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn
          color="green darken-1"
          text
          @click="$emit('agree')"
        >
          >
          Disagree
        </v-btn>
        <v-btn
          color="green darken-1"
          text
          @click="$emit('disagree')"
        >
          >
          Agree
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: null,
    },
    answer: {
      type: String,
      default: null,
    },
  },
}
</script>

<style></style>