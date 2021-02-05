<template>
  <v-card
    class="elevation-0 ma-auto mb-5 px-7 pb-7"
    color="#FFFFFF"
    :disabled="(loadingstate)"
  >
    <div class="d-flex row justify-space-between mt-5 mb-7">
      <v-card-title class="display-3 my-3">
        Post your answer
      </v-card-title>
      <v-icon @click="$emit('close')">
        mdi-close-box
      </v-icon>
    </div>
    
    <v-textarea
      v-model="form.body"
      label="Topic description"
      hint="Give the clearer answer please"
      outlined
      rows="3"
      row-height="45"
      class="mb-5"
    />
    <v-file-input
      outlined
      multiple
      label="File input"
      dense
    />
    <create-button
      text="Post your answer"
      :loading="loadingstate"
      :disabled="loadingstate"
      @click="create"
    />
  </v-card>
</template>

<script>
import CreateButton from '../UiElements/CreateButton.vue'

export default {
  components: { CreateButton },
  data() {
    return {
      loadingstate: null,
      error: false,
      form: {
        title: null,
        description: null,
        tags: [],
      },
    }
  },
  methods: {
    create() {
      this.loadingstate = true
    },
  },
}
</script>

<style scoped></style>