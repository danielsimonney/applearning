<template>
  <v-card-text class="d-flex align-left flex-column">
    <v-card-title class="display-3 ">
      Sign up! 
    </v-card-title>
    <v-card-title class="blue--text display-1">
      Tell us more about you!
    </v-card-title>
    <text-input
      v-model="form.email"
      placeholder="email"
    />
    <text-input
      v-model="form.name"
      placeholder="name"
    />
    <text-input
      v-model="form.password"
      placeholder="password"
    />
    <text-input
      v-model="form.confirmation"
      placeholder="confirmation password"
    />
    <v-card-actions class="justify-center align-center">
      <base-button
        text="Sign up"
        :loading="shouldDisplayLoadingSpinner"
        :disabled="shouldDisplayLoading"
        @click="$emit('signUp')"
      />
    </v-card-actions>
  </v-card-text>
</template>

<script>
import TextInput from '../UiElements/TextInput.vue';
import BaseButton from '../UiElements/BaseButton.vue'

export default {
  components:{
    TextInput,
    BaseButton
  },
  props: {
   loading:{
    type:String,
   default:null
   }
},
   data() {
    return {
      form: {
        email:'',
        password:'',
        name:'',
        confirmation:''
      }
    }
  },
  computed: {
    shouldDisplayLoadingSpinner() {
      return (this.loading && this.loading=='register') ? true : false;
    },
    shouldDisplayLoading(){
      return (this.loading) ? true : false;
    },

  },
  mounted() {
    console.log(this.loading)
  },

}
</script>
