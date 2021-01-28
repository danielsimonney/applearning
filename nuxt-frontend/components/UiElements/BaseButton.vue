<template>
  <v-btn
    class="btn-basic"
    width="200px"
    height="70px"
    rounded
    outlined
    v-bind="$attrs"
    @click="$emit('click', $event)"
  >
    {{ text }} 
  </v-btn>
</template>

<script>
export default {
  props: {
    value:{
      type:String,
      default:null,
    },
    text:{
      type:String,
      default:null,
    }
},
   data() {
    return {
    }
  },
  computed: {

  },
  mounted() {
    
  },

}
</script>
<style scoped>
.btn-basic{
  font-size: 20px;
  border-radius: 50px;
  color: white;
  background-color: #90D2E7;
}
</style>