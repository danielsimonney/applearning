<template>
  <v-card
    class="elevation-0 ma-auto mb-5 px-7 pb-7"
    color="#FFFFFF"
    :disabled="(loadingstate)"
  >
    <v-card-title class="display-3 my-3">
      Edit your topic
    </v-card-title>
    <text-input
      v-model="form.title"
      hint="The header must contains a maximum of 200 characters"
      label="Enter a title"
      placeholder="Topic title"
      class="mb-5"
    />
    <v-textarea
      v-model="form.description"
      label="Topic description"
      hint="Give a description of what your problem is"
      outlined
      rows="3"
      row-height="45"
      class="mb-5"
    />
    <p class="font-weight-black">
      Add tags
    </p>
    <div class="tagsList rounded-lg my-5">
      <div class="px-4 py-3 d-flex wrap row">
        <base-checkbox
          v-for="(tag,index) in tags.data"
          :key="index"
          :label="tag.name"
          @input="toggleCheckbox($event,tag.id)"
        />
      </div>
    </div>
    <v-file-input
      outlined
      multiple
      label="File input"
      dense
    />
    <base-button
      text="Create topic"
      :loading="loadingstate"
      :disabled="loadingstate"
      @click="create"
    />
  </v-card>
</template>

<script>
import BaseButton from '../../../components/UiElements/BaseButton.vue'
import BaseCheckbox from '../../../components/UiElements/baseCheckbox.vue'
import TextInput from '../../../components/UiElements/TextInput.vue'
export default {
  components: { TextInput, BaseCheckbox, BaseButton },
  async asyncData({ params, $axios }) {
    try {
      const tags = await $axios.$get('/tags')
      const { data } = await $axios.$get(`/topics/${params.id}`)
      console.log(data)
      return {
        tags: tags,
        topic: data,
      }
    } catch (err) {
      console.log(err)
    }
  },
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
  mounted() {
    console.log(this.topic)
    this.form.title = this.topic.title
    this.form.description = this.topic.description
    this.form.tags = this.topic.tags
  },
  methods: {
    toggleCheckbox(state, id) {
      console.log(state, id)
    },
    create() {
      this.loadingstate = true
    },
  },
}
</script>

<style scoped>
.tagsList {
  border: 1px solid rgba(54, 54, 53, 0.582);
}
</style>