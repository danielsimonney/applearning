<template>
  <v-card-text class="d-flex align-left flex-column">
    <v-card-title class="display-3 ">
      Log in!
    </v-card-title>
    <v-card-title class="blue--text display-1">
      Happy to see you again!
    </v-card-title>

    <text-input
      v-model="form.email"
      placeholder="email"
    />
    <text-input
      v-model="form.password"
      placeholder="password"
    />

    <v-card-actions class="justify-center align-center">
      <base-button
        text="Go sign in"
        :loading="(loading && loading=='login') ? true : false"
        :disabled="(loading) ? true : false"
        @click="$emit('logIn')"
      />


      <!-- <v-btn
        color="purple darken-2"
        outlined
        :loading="(loading && loading=='login') ? true : false"
        :disabled="(loading) ? true : false"
        @click="$emit('logIn')"
      >
        Log in
      </v-btn> -->
    </v-card-actions>
  </v-card-text>
</template>

<script>
import BaseButton from '../UiElements/BaseButton.vue'
import TextInput from '../UiElements/TextInput.vue'
export default {
  components: { TextInput, BaseButton },
  props: {
    loading: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  mounted() {
    console.log('in the login')
  },
  methods: {
    toto(e) {
      console.log(e)
    },
  },
}
</script>
