<template>
  <v-card
    class="elevation-0 ma-auto mb-5 px-7 pb-7"
    color="#FFFFFF"
    :disabled="(loadingstate)"
  >
    <v-card-title class="display-3 my-3">
      Create a new topic !
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

    <check-box-tags
      v-model="form.tags"
      :items="allTags"
    />
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
import CheckBoxTags from '~/components/forms/CheckBoxTags.vue'
import BaseButton from '../../components/UiElements/BaseButton.vue'
import TextInput from '../../components/UiElements/TextInput.vue'
export default {
  components: { TextInput, BaseButton, CheckBoxTags },
  async asyncData({ $axios }) {
    // console.log('hi')
    try {
      const { data } = await $axios.$get('/tags')
      return {
        tags: data,
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
  computed: {
    allTags() {
      return this.tags.map(item => ({
        text: item.name,
        value: item.id,
      }))
    },
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